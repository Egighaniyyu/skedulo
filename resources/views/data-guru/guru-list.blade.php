@extends('data-guru.index')

@section('content-guru')
<div class="table-responsive">
    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
        <thead class="student-thread">
            <tr>
                <th>
                    <div class="form-check check-tables">
                        <input class="form-check-input" type="checkbox" value="something">
                    </div>
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guru as $guru)
            <tr>
                <td>
                    <div class="form-check check-tables">
                        <input class="form-check-input" type="checkbox" value="something">
                    </div>
                </td>
                <td>{{$guru->id}}</td>
                <td>
                    <h2 class="table-avatar">
                        <a href="#" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                src="{{ asset('public/guru/'.$guru->foto) }}" alt="User Image"></a>
                        <a href="#">{{$guru->nama}}</a>
                    </h2>
                </td>
                <td>{{$guru->email}}</td>
                <td>{{$guru->password}}</td>
                <td>{{$guru->role}}</td>
                <td class="text-end">
                    <div class="actions">
                        <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-sm bg-success-light me-2">
                            <i class="feather-edit"></i>
                        </a>
                        <form action="{{ route('guru.destroy', $guru->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm bg-danger-light" type="submit">
                                <i class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            {{-- <tr>
                <td>
                    <div class="form-check check-tables">
                        <input class="form-check-input" type="checkbox" value="something">
                    </div>
                </td>
                <td>PRE2209</td>
                <td>
                    <h2 class="table-avatar">
                        <a href="teacher-details.html" class="avatar avatar-sm me-2"><img
                                class="avatar-img rounded-circle" src="assets/img/profiles/avatar-02.jpg"
                                alt="User Image"></a>
                        <a href="teacher-details.html">Aaliyah</a>
                    </h2>
                </td>
                <td>10</td>
                <td>Female</td>
                <td>Mathematics</td>
                <td>A</td>
                <td>097 3584 5870</td>
                <td>911 Deer Ridge Drive,USA</td>
                <td class="text-end">
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-sm bg-success-light me-2">
                            <i class="feather-eye"></i>
                        </a>
                        <a href="edit-teacher.html" class="btn btn-sm bg-danger-light">
                            <i class="feather-edit"></i>
                        </a>
                    </div>
                </td>
            </tr> --}}

        </tbody>
    </table>
</div>
@endsection