<!-- resources/views/vms/index.blade.php -->
<x-admin>
    <div class="container">
        <h1>Virtual Machines</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(!empty($vms))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado de Energía</th>
                        <th>Guest OS</th>
                        <th>Hardware Version</th>
                        <th>Tools Version</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vms as $vm)
                        <tr>
                            <td>{{ $vm->name }}</td>
                            <td>{{ $vm->power_state }}</td>
                            <td>{{ $vm->guest_OS }}</td>
                            <td>{{ $vm->hardware_version ?? 'N/A' }}</td>
                            <td>{{ $vm->tools_version_status ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No se encontraron VMs.</p>
        @endif
    </div>
</x-admin>
