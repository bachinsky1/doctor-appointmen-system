@role('health-professional')

@extends('layouts.app')

@section('content')

@auth

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif


<div class="row">
    <div class="col-6">
        <div class="card min-vh-100 mb-5">

            <div class="card-header">
                Next appointments
            </div>
            <div class="card-body">



            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="row">
            <div class="col-12">

                <div class="card  min-vh-50">

                    <div class="card-header">
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle w-100" type="button" id="dropdownMenuDashboardDocuments" data-bs-toggle="dropdown" aria-expanded="false">
                                Documents to classify
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuDashboardDocuments">
                                <li><a class="dropdown-item" href="#">Upload new document</a></li>
                                <li><a class="dropdown-item" href="#">Sort by date: Newest firstly</a></li>
                                <li><a class="dropdown-item" href="#">Sort by date: Oldest firstly</a></li>

                            </ul>
                        </div>

                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Work incapacity</li>
                            <li class="list-group-item">Medical prescription</li>
                            <li class="list-group-item">Radiology request</li>
                            <li class="list-group-item">Free letter</li>
                            <li class="list-group-item">Delegation Form</li>
                            <li class="list-group-item">Free Prescription</li>
                            <li class="list-group-item">Medication plan</li>
                            <li class="list-group-item">Rapport 14.01.2021</li>
                            <li class="list-group-item">Drug Prescription</li>
                        </ul>

                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="card min-vh-50 mt-4">
                    <div class="card-header">
                        Activities
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Created new invoice</li>
                            <li class="list-group-item">Closed consultation </li>
                            <li class="list-group-item">Document deleted</li>
                            <li class="list-group-item">Document classified</li>  
                        </ul>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <div class="col-3">
        <div class="card  min-vh-100">
            <div class="card-header">
                Tasks
            </div>

            <div class="card-body">
                <div class="bd-example">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">To-do</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Planified</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>Analysis request for Tom Nohome</p>
                            <p>Analysis request for Tom Nohome</p>
                            <p>Analysis request for Tom Nohome</p>
                            <p>Analysis request for Tom Nohome</p>
                            <p>Analysis request for Tom Nohome</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <p>Empty task without files</p>
                        </div>
                    </div>
                </div>



            </div>
        </div>



    </div>
</div>



@endauth

@endsection

@endrole
