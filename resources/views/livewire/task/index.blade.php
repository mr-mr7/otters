<div class="p-4">
    <div class="card mt-2">
        <div class="card-body">
            <table class="table text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>توضیحات</th>
                    <th>تاریخ پایان</th>
                    <th>اولویت</th>
                    <th>وضعیت</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @if ($tasks->count() > 0)
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->user->name }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->des }}</td>
                            <td>{{ $task->end_at }}</td>
                            <td>{!! $task->priority_tag !!}</td>
                            <td>{!! $task->status_tag !!}</td>
                            <td dir="ltr">{{ $task->created_at }}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-center">هیچ تسکی در حال حاضر موجود نمیباشد</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! $tasks->links() !!}
        </div>
    </div>
</div>
