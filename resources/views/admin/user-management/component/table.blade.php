<div>
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                ID
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Photo
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Firstname
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Lastname
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Email
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                role
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Status
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Creation Date
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                </td>
                <td>
                    <div>
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                    </div>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$user->lastname}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ucfirst($user->type)}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">PENDING</p>
                </td>
                <td class="text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{$user->created_at}}</span>
                </td>
                <td class="text-center">
                    <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                        <i class="fas fa-user-edit text-secondary"></i>
                    </a>
                    <span>
                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="card-footer pb-0">
        {{$users->links()}}
    </div>
</div>
