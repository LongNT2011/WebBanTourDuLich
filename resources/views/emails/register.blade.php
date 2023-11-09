@component('mail::message')
    <h1>Xin chào {{$user->fullName}},</h1>
    <p>Vui lòng nhấp vào nút bên dưới để xác minh Email của bạn.</p>
    @component('mail::button', ['url' => url('verify/'.$user->remember_token)])
        Xác minh địa chỉ Email
    @endcomponent
    <p>Nếu bạn chưa tạo tài khoản thì không cần thực hiện thêm hành động nào.</p>
    <p>Trân trọng,<br>Nhóm 8.</p>
@endcomponent
