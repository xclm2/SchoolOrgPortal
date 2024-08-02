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
        @foreach($advisers as $adviser)
            <tr>
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">{{$adviser->id}}</p>
                </td>
                <td>
                    <div>
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                    </div>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$adviser->name}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$adviser->lastname}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$adviser->email}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ucfirst($adviser->type)}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">PENDING</p>
                </td>
                <td class="text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{$adviser->created_at}}</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm mb-0 js-select-adviser"
                            data-id="{{$adviser->id}}"
                            data-name="{{$adviser->name}} {{$adviser->lastname}}">Select
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="card-footer pb-0">
        {{$advisers->links()}}
    </div>
</div>
