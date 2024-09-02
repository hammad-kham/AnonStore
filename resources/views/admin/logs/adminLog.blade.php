@extends('layouts.admin')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Add your page content here -->
    <!-- Example content -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
              


                <h1>Audit Logs</h1>

                <!-- Display a table of audits -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event</th>
                            <th>Auditable Type</th>
                            <th>Auditable ID</th>
                            <th>User ID</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($audits as $audit)
                            <tr>
                                <td>{{ $audit->id }}</td>
                                <td>{{ $audit->event }}</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>{{ $audit->auditable_id }}</td>
                                <td>{{ $audit->user_id }}</td>
                                <td>{{ json_encode($audit->old_values) }}</td>
                                <td>{{ json_encode($audit->new_values) }}</td>
                                <td>{{ $audit->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>











                
            </div>
        </div>
    </section>

</main>
<!-- End Main Content -->

 @endsection
