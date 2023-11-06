<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Order Detail</title>
</head>
<body>
<div class="container pt-4 mt-0 mt-lg-4">
    <div class="row" style="border: 1px solid #aaa;">

        <div class="col-12 col-lg-7 p-4 2 mt-4 mt-md-0">
            <div class="row p-1 my-1 " style="border-radius:20px; ">
                <div class="col-6">
                    <h3 class="text-success">Thông Tin Đơn Hàng</h3>
                </div>
                <div class="text-end col-6 ">
                    <a asp-controller="Home" asp-action="Index"
                                     class="btn btn-sm btn-outline-danger" style="width:200px;">
                        <i class="bi bi-arrow-left-square"></i> &nbsp; Trở Lại
                    </a>
                </div>
                <hr />
                <div class="row">
    <div class="col-12 col-md-5">
        <img src="./images/orderConfirmed.jpg" style="border-radius:10px;" width="100%" />
    </div>
    <div class="col-12 col-md-7">
        <div class="row p-2">
            <div class="col-12">
                <p class="card-title text-danger" style="font-size:xx-large">Tên Tour</p>
                <p class="card-text" style="font-size:large">
                    Mô Tả
                </p>
            </div>
        </div>
        <div class="row col-12">
            <span class="text-end p-0 pt-3 m-0">
                <span class="float-right">Số Người </span><br />
                <span class="float-right pt-1">Khuyến Mãi</span><br />
                <p class="text-danger font-weight-bold pt-1">
                    VNĐ:
                    <span style=" #ff6a00">
                       Giá / Người
                    </span>
                </p>
            </span>
        </div>
    </div>
</div> 
                <hr />
                <div class="text-end">
                    <h4 class="text-danger font-weight-bold ">
                        Tổng Tiền :
                        <span style="border-bottom:1px solid #ff6a00">
                            1.000.000 VNĐ
                        </span>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 p-4 2 mt-4 mt-md-0" style="border-left:1px solid #aaa">
            <form method="post">
                <input asp-for="VillaId" hidden />
                <input asp-for="UserId" hidden />
                <input asp-for="CheckInDate" hidden />
                <input asp-for="CheckOutDate" hidden />
                <input asp-for="Nights" hidden />
                <div class="row pt-1 mb-3 " style="border-radius:20px; ">
                    <div class="col-12">
                        <h3 class="text-success">Enter Booking Details</h3>
                    </div>
                </div>

                <div class="form-group pt-0">
                    <label asp-for="Name" class="text-danger">Name</label>
                    <input asp-for="Name" class="form-control" />
                    <span asp-validation-for="Name" class="text-danger"></span>
                </div>
                <div class="form-group pt-2">
                    <label asp-for="Phone" class="text-danger">Phone</label>
                    <input asp-for="Phone" class="form-control" />
                    <span asp-validation-for="Phone" class="text-danger"></span>
                </div>
                <div class="form-group pt-2">
                    <label asp-for="Email" class="text-danger">Email</label>
                    <input asp-for="Email" class="form-control" />
                    <span asp-validation-for="Email" class="text-danger"></span>
                </div>
                <div class="form-group pt-2">
                    <label asp-for="CheckInDate" class="text-danger">Check in Date</label>
                    <input asp-for="CheckInDate" disabled class="form-control" />
                </div>
                <div class="form-group pt-2">
                    <label asp-for="CheckOutDate" class="text-danger">Check Out Date</label>
                    <input asp-for="CheckOutDate" disabled class="form-control" />
                </div>
                <div class="form-group pt-2">
                    <label asp-for="Nights" class="text-danger">No. of nights</label>
                    <input asp-for="Nights" disabled class="form-control" />
                </div>
                <div class="form-group pt-2 pt-md-4">
                    <button type="submit" class="btn btn-success form-control">Thanh Toán</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
