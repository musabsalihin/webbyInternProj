<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <table class="mt-4 w-full table-auto text-center overflow-x-scroll">
        <tr class="py-12 border bg-gray-200 border-gray-300 ">
            <th class="p-4">ID</th>
            <th class="text-left w-1/3 p-4">Name</th>
            <th class="text-left w-1/3 p-4">Email</th>
            <th class="p-4 max-w-fit">Status</th>
            <th class="p-4"></th>
            <th class="p-4"></th>
        </tr>
        @foreach($users as $user)
        <tr class="h-8 border-b border-gray-300">
            <td class="py-2 px-4">{{$user->id}}</td>
            <td class="text-left py-2 px-4">{{$user->name}}</td>
            <td class="text-left py-2 px-4">{{$user->email}}</td>
            <td class="py-2 px-4">
            @if($user->email_verified_at)
            {{'Verified'}}
            @else
            {{'Unverified'}}
            @endif
            </td>
            <td class="py-2 px-4">
                <a class="w-full inline-flex items-center justify-center py-1 px-4 bg-blue-400 rounded-xl text-white font-semibold hover:cursor-pointer hover:bg-blue-500 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150" 
                href="{{route('users.edit', ['user' => $user])}}">Edit</a>
            </td>
            <td class="py-2 px-4">
                <form method="post" action="{{route('users.delete', ['user' => $user])}}">
                    @csrf
                    @method('delete')
                    <input class="w-full py-1 px-2 bg-red-400 rounded-xl text-white font-semibold hover:cursor-pointer hover:bg-red-500 focus:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150" 
                    type="submit" value="Delete" />
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>