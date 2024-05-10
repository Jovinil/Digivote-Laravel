@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    @if (session()->has('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session()->has('danger'))
    <div class="alert alert-danger mt-3" role="alert">
        {{ session('danger') }}
    </div>
    @endif
    {{-- <a href="{{ route('candidate.test') }}">Test</a> --}}
    {{-- <main class="container bg-light d-flex flex-column gap-4 p-1"> --}}
        <div class="container-fluid">
            <h3 class="fw-bold">Final Voting Time:</h3>
            <p>12:00AM-02/02/24 --- 12:00AM-03/02/24</p>
        </div>
        <div class="container-fluid">
            <div class="row d-flex flex-lg-row flex-column gap-2" id="cards-container">
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Overall Candidates</h5>
                    <div class="d-flex gap-3 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="{{ route('admin.candidate-list') }}" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
                {{-- <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Number of Voters</h5>
                    <div class="d-flex gap-2 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="{{ route('admin.voters') }}" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div> --}}
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Overall Voters</h5>
                    <div class="d-flex gap-3 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href=" {{ route('admin.voters') }} " class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- tally -->
        <div class="container shadow py-2 gap-2 position-relative" id="window-container">

            <div class="row">
                <button type="button" class="btn fs-5 ms-auto fw-bold" style="width: fit-content;">ICON</button>
            </div>


            <!-- Tally main container -->
            <div class="row overflow-auto py-3 d-flex gap-2" id="main-tally-container">
               <!-- Rows are added dynamically -->
            </div>

            <a href="{{ route('admin.candidate-poll') }}" class="btn btn-dark position-absolute bottom-0 end-0 m-5 ">Show all</a>

        </div>
        <!-- tally -->

         <!-- crud -->
        <div class="container shadow candidate-container pt-2 pb-2">

            <div class="row d-flex justify-content-center align-items-center my-3">
                <div class="w-auto bg-secondary fw-bold fs-4 rounded-1 px-3 py-2" id="lc-heading">List of Candidates</div>
            </div>

            <!-- accordion container -->
            <div class="row px-4" id="table-container">

                <table class="table" id="candidate-table">
                    <thead>
                        <th>Party Icon</th>
                        <th>Party Name</th>
                        <th class="visibility-hidden">position</th>
                        <th>Candidate Name</th>
                        <th>Controls</th>
                    </thead>
                    <tbody>
                        @foreach ($compiledData as $data)
                        <tr>
                            @php
                                $party =  $data['party'];
                                $candidatePosition = $data['candidate']->position_id;
                                $candidateID = $data['candidate']->candidate_id;
                                $partyIcon = $data['party']->party_img ?? null;
                                $test = null;
                            @endphp


                            @if($party !== null)
                                <td> <img src="{{ asset('images/' . $partyIcon) }}" class="rounded-circle" id="party-icon" alt="party icon"> </td>
                                <td>{{ $data['party']->party_name }}</td>
                            @else
                                <td>No Party</td>
                                <td>No Party</td>
                            @endif

                            @switch($candidatePosition)
                                @case(1)
                                    <td class="visibility-hidden">President</td>
                                    @break
                                @case(2)
                                    <td class="visibility-hidden">Vice President</td>
                                    @break
                                @case(3)
                                    <td class="visibility-hidden">Secretary</td>
                                    @break
                                @case(4)
                                    <td class="visibility-hidden">Treasurer</td>
                                    @break
                                @case(5)
                                    <td class="visibility-hidden">Auditor</td>
                                    @break
                                @case(6)
                                    <td class="visibility-hidden">Business Manager</td>
                                    @break
                                @case(7)
                                    <td class="visibility-hidden">Business Manager</td>
                                    @break
                            @endswitch

                            <td>{{ $data['student']->stud_lastname }}, {{ $data['student']->stud_firstname }} {{ $data['student']->stud_middlename }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('candidate.view', $candidateID) }}" class="btn btn-secondary">View <i class="bi bi-eye"></i></a>
                                <a href="{{ route('candidate.edit', $candidateID) }}"  class="btn btn-dark">Edit <i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row py-2">
                <div class="col d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.candidate-list') }}" class="btn btn-secondary">Show all</a>
                    <div class="dropdown">
                        <button type="button" class="btn btn-dark" id="add-dropdown" data-bs-toggle="dropdown" aria-expanded="false">Add</button>
                        <ul class="dropdown-menu" aria-labelledby="add-dropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.party-add-candidate') }}">By Party</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.position-add-candidate') }}">By position</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- buttons row --}}
              <!-- crud -->

        </div>

    {{-- </main> --}}
    {{-- <script defer>
        var candidateEditRoute = "{{ route('admin.candidate-edit') }}";
        var candidateViewRoute = "{{ route('admin.candidate-view') }}";
    </script> --}}
    <script defer src="{{ asset('custom-scripts/admin.js') }}"></script>

@endsection