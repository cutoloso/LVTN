<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0"
       style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"
       width="100%">
    <tbody>
    <tr>
        <td align="center"
            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
            valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
                <tbody>
                <tr>
                    <td align="center" valign="bottom"
                        style="border-bottom:3px solid #f29f29;padding-bottom:10px;background-color:#fff"
                        width="100%">
                    </td>
                </tr>

                <tr style="background:#fff">
                    <td align="left" height="auto" style="padding:15px" width="600">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">
                                        Cảm ơn quý khách {{$order->name}} đã đặt hàng tại AZMobile,</h1>

                                    <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        AZMobile rất vui thông báo đơn hàng #{{$order->id}} của quý khách đã được tiếp nhận
                                        và đang trong quá trình xử lý. AZMobile sẽ thông báo đến quý khách ngay khi hàng
                                        chuẩn bị được giao.</p>

                                    <h3 style="font-size:13px;font-weight:bold;color:#f29f29;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">
                                        Thông tin đơn hàng #{{$order->id}} <span
                                            style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày {{$order->created_at}})</span>
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th align="left"
                                                style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"
                                                width="50%">Thông tin thanh toán
                                            </th>
                                            <th align="left"
                                                style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"
                                                width="50%"> Địa chỉ giao hàng
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
                                                valign="top"><span
                                                    style="text-transform:capitalize">{{$order->name}}</span><br>
                                                {{--                                                <a href="mailto:d.c.thanh1997@gmail.com" target="_blank">d.c.thanh1997@gmail.com</a><br>--}}
                                                {{$order->phone}}</td>
                                            <td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
                                                valign="top"><span
                                                    style="text-transform:capitalize">{{$order->name}}</span><br>
                                                <br>
                                                {{$order->address}}<br>
                                                SĐT: {{$order->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"
                                                style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444"
                                                valign="top">
                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                    <strong>Phương thức thanh toán: </strong> {{$order->pay_mth_name}}
                                                    <br>
                                                    <strong>Thời gian giao hàng dự kiến:</strong> Dự kiến 3 ngày kể từ
                                                    ngày {{$order->created_at}} - không giao ngày Thứ Bảy &amp; Chủ Nhật
                                                    <br>
                                                    <strong>Phí vận chuyển: </strong> 0&nbsp;₫<br>
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        <i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể
                                            yêu cầu người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc
                                            ghi lại thông tin.</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#f29f29">
                                        CHI TIẾT ĐƠN HÀNG</h2>

                                    <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th align="left" bgcolor="#f29f29"
                                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                                Sản phẩm
                                            </th>
                                            <th align="left" bgcolor="#f29f29"
                                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                                Đơn giá
                                            </th>
                                            <th align="left" bgcolor="#f29f29"
                                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                                Số lượng
                                            </th>
                                            <th align="left" bgcolor="#f29f29"
                                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                                Giảm giá
                                            </th>
                                            <th align="right" bgcolor="#f29f29"
                                                style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                                Tổng tạm
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody bgcolor="#eee"
                                               style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                        @foreach($order->order_details as $order_item)
                                            <tr>
                                                <td align="left" style="padding:3px 9px" valign="top"><span>{{$order_item->name}}</span><br>
                                                </td>
                                                <td align="left" style="padding:3px 9px" valign="top">
                                                    <span>{{$order_item->price}}&nbsp;₫</span></td>
                                                <td align="left" style="padding:3px 9px" valign="top">{{$order_item->quantity}}</td>
                                                <td align="left" style="padding:3px 9px" valign="top"><span>{{$order_item->price_sale}}&nbsp;₫</span>
                                                </td>
                                                <td align="right" style="padding:3px 9px" valign="top">
                                                    <span>{{$order_item->price_sale}}&nbsp;₫</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot
                                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                        <tr>
                                            <td align="right" colspan="4" style="padding:5px 9px">Tổng tạm tính</td>
                                            <td align="right" style="padding:5px 9px"><span>{{$order->total_price}}&nbsp;₫</span></td>
                                        </tr>
                                        <tr>
                                            <td align="right" colspan="4" style="padding:5px 9px">Phí vận chuyển</td>
                                            <td align="right" style="padding:5px 9px"><span>0&nbsp;₫</span></td>
                                        </tr>
                                        <tr bgcolor="#eee">
                                            <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá
                                                        trị đơn hàng</big> </strong></td>
                                            <td align="right" style="padding:7px 9px">
                                                <strong><big><span>{{$order->total_price}}&nbsp;₫</span> </big> </strong></td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;
                                    <p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        Bạn cần được hỗ trợ ngay? Chỉ cần email <a href="mailto:hotro@AZMobile.vn"
                                                                                   style="color:#099202;text-decoration:none"
                                                                                   target="_blank"> <strong>hotro@AZMobile.vn</strong>
                                        </a>, hoặc gọi số điện thoại <strong style="color:#099202">1900-6035</strong>
                                        (8-21h cả T7,CN). Đội ngũ AZMobile luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;
                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                                        Một lần nữa AZMobile cảm ơn quý khách.</p>

                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">
                                        <strong><a href="" style="color:#00a3dd;text-decoration:none;font-size:14px"
                                                   target="_blank">AZMobile</a> </strong></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table width="600">
                <tbody>
                <tr>
                    <td>
                        <p align="left"
                           style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">
                            Quý khách nhận được email này vì đã mua hàng tại AZMobile.<br>
                            Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ AZMobile, quý khách vui
                            lòng thêm địa chỉ <strong><a href="mailto:hotro@AZMobile.vn" target="_blank">hotro@AZMobile.vn</a></strong>
                            vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
                            <b>Văn phòng AZMobile:</b> 123, đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Cần Thơ<br>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
