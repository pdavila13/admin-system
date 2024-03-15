<x-admin>
    @section('title')
        {{ 'Petition Detail' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Petition Detail</h3>
            <div class="card-tools">
                <a href="{{ route('admin.petition.index') }}" class="btn btn-info btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">General</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
                </div>
                </div>
                <div class="card-body">
                <div class="form-group">
                <label for="company">Company Name</label>
                <input type="text" id="company" class="form-control" value="{{ $data->company->name }}">
                </div>
                <div class="form-group">
                <label for="inputDescription">Company Description</label>
                <textarea id="inputDescription" class="form-control" rows="4">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</textarea>
                </div>
                <div class="form-group">
                <label for="inputStatus">Status</label>
                <select id="inputStatus" class="form-control custom-select">
                <option disabled>Select one</option>
                <option>On Hold</option>
                <option>Canceled</option>
                <option selected>Success</option>
                </select>
                </div>
                <div class="form-group">
                <label for="inputClientCompany">Client Company</label>
                <input type="text" id="inputClientCompany" class="form-control" value="Deveint Inc">
                </div>
                <div class="form-group">
                <label for="inputProjectLeader">Project Leader</label>
                <input type="text" id="inputProjectLeader" class="form-control" value="Tony Chicken">
                </div>
                </div>
                
                </div>
                
                </div>
                <div class="col-md-6">
                
                <div class="card card-info">
                <div class="card-header">
                <h3 class="card-title">Files</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
                </div>
                </div>
                <div class="card-body p-0">
                <table class="table">
                <thead>
                <tr>
                <th>File Name</th>
                <th>File Size</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>Functional-requirements.docx</td>
                <td>49.8005 kb</td>
                <td class="text-right py-0 align-middle">
                <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </div>
                </td>
                <tr>
                <td>UAT.pdf</td>
                <td>28.4883 kb</td>
                <td class="text-right py-0 align-middle">
                <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </div>
                </td>
                <tr>
                <td>Email-from-flatbal.mln</td>
                <td>57.9003 kb</td>
                <td class="text-right py-0 align-middle">
                <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </div>
                </td>
                <tr>
                <td>Logo.png</td>
                <td>50.5190 kb</td>
                <td class="text-right py-0 align-middle">
                <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </div>
                </td>
                <tr>
                <td>Contract-10_12_2014.docx</td>
                <td>44.9715 kb</td>
                <td class="text-right py-0 align-middle">
                <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </div>
                </td>
                </tbody>
                </table>
                </div>
                
                </div>
                
                </div>
                </div>
        </div>
            
    </div>
</x-admin>
