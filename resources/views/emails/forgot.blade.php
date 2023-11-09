@component('mail::message')
    <h1>Xin chào {{$user->fullName}},</h1>
    <p>Vui lòng bấm vào nút bên dưới để đặt lại mật khẩu của bạn.</p>
    @component('mail::button', ['url' => url('reset/'.$user->remember_token)])
        Đặt lại mật khẩu
    @endcomponent
    <p>Trong trường hợp bạn có bất kỳ vấn đề nào khi khôi phục mật khẩu, vui lòng liên hệ với chúng tôi.</p>
    <p>Trân trọng,<br>Nhóm 8.</p>
@endcomponent
