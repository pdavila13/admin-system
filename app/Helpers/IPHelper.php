<?php

namespace App\Helpers;

class IPHelper
{
    /**
     * Obtener las IPs disponibles dentro de una red, excluyendo las IPs usadas.
     *
     * @param string $network Dirección de red (por ejemplo, '192.168.1.0')
     * @param string $mask Máscara de subred en formato decimal (por ejemplo, '255.255.255.0')
     * @param array $usedIPs Array de direcciones IP usadas (por ejemplo, ['192.168.1.1', '192.168.1.2'])
     * @return array Lista de IPs disponibles
     */
    public static function getAvailableIPs($network, $mask, $usedIPs)
    {
        // Convertir la red a binario
        $binNet = self::dqtobin($network);
        // Convertir la máscara decimal a CIDR (número de bits en 1)
        $cidr = self::maskToCidr($mask);
        // Convertir el CIDR a una máscara binaria
        $binMask = self::cdrtobin($cidr);

        // Obtenemos la longitud efectiva de la máscara en bits (la parte significativa)
        $maskLength = strlen(rtrim($binMask, '0'));

        // Determinar la primera y la última dirección IP en el rango (en binario)
        $binFirst = str_pad(substr($binNet, 0, $maskLength), 32, '0');
        $binLast  = str_pad(substr($binNet, 0, $maskLength), 32, '1');

        // Convertir las IPs usadas a formato numérico (para comparaciones más rápidas)
        $usedIPsNumeric = array_map(function($ip) {
            return ip2long($ip);
        }, $usedIPs);

        // Generar el rango de IPs disponibles
        $range = [];
        for ($i = bindec($binFirst) + 1; $i < bindec($binLast); $i++) {
            $ip = self::bintodq(str_pad(decbin($i), 32, '0', STR_PAD_LEFT));
            $ipNumeric = ip2long($ip);
            if (!in_array($ipNumeric, $usedIPsNumeric)) {
                $range[] = $ip;
            }
        }

        return $range;
    }

    /**
     * Convertir una dirección IP en formato decimal a binario (sin separadores).
     *
     * @param string $dqin Dirección IP en formato decimal (por ejemplo, '192.168.1.0')
     * @return string Dirección IP en formato binario (por ejemplo, '11000000101010000000000100000000')
     */
    private static function dqtobin($dqin)
    {
        $dq = explode('.', $dqin);
        $bin = [];
        for ($i = 0; $i < 4; $i++) {
            $bin[$i] = str_pad(decbin($dq[$i]), 8, '0', STR_PAD_LEFT);
        }
        return implode('', $bin);
    }

    /**
     * Convertir una máscara en formato decimal a un valor CIDR.
     *
     * @param string $mask Máscara en formato decimal (por ejemplo, '255.255.255.0')
     * @return int Número de bits en 1 (por ejemplo, 24)
     */
    private static function maskToCidr($mask)
    {
        return substr_count(decbin(ip2long($mask)), '1');
    }

    /**
     * Convertir un valor CIDR a una máscara binaria.
     *
     * @param int $cdrin Número de bits en 1 (por ejemplo, 24)
     * @return string Máscara binaria de 32 bits (por ejemplo, '11111111111111111111111100000000')
     */
    private static function cdrtobin($cdrin)
    {
        // $cdrin es un entero, por ejemplo 24
        return str_pad(str_repeat('1', $cdrin), 32, '0');
    }

    /**
     * Convertir una cadena binaria de 32 bits a una dirección IP en formato decimal.
     *
     * @param string $binin Cadena binaria de 32 bits
     * @return string Dirección IP en formato decimal (por ejemplo, '192.168.1.0')
     */
    private static function bintodq($binin)
    {
        // Dividir la cadena en bloques de 8 bits
        $chunks = str_split($binin, 8);
        $dq = array_map('bindec', $chunks);
        return implode('.', $dq);
    }
}