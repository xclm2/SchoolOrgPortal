<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            ID
        </th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Name
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Members
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Status
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Created
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Action
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($organizations as $org)
        <tr>
            <td class="ps-4">
                <p class="text-xs font-weight-bold mb-0">1</p>
            </td>
            <td>
                <div>
                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                </div>
            </td>
            <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{$org->name}}</p>
            </td>
            <td class="text-center">
                <p class="text-xs font-weight-bold mb-0"></p>
            </td>
            <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{$org->status}}</p>
            </td>
            <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{$org->created_at}}</p>
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

{{$organizations->links()}}
