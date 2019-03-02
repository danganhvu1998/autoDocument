@extends('layouts.app')

@section('content')
    <h1>Hướng dẫn sử dụng hệ thống</h1>
    <h2>Thẻ Students</h2>
    <ul>
        <li>Yêu cầu: Nhân viên level 1</li>
        <li>Chọn ALL STUDENTS để xem toàn bộ học sinh mình có quyền quản lý</li>
        <li>1 học sinh sẽ có nhiều thông tin được đăng ký, và nhiều giấy tờ. Mỗi giấy tờ lại có nhiều thông tin, hệ thống sẽ kiểm tra giữa cùng mục thông tin xem có sự sai khác giữa giấy tờ và thông tin được đăng ký không. Nếu có sẽ có thông báo lỗi khi kéo xuống dưới phần các giấy tờ.</li>
        <li>Nếu không có sai khác, người dùng sẽ được quyền yêu cầu autoDocument (sẽ giải thích sau)</li>
    </ul>
    <h2>Thẻ Definitions</h2>
    <ul>
        <li>Yêu cầu: Nhân viên level 1 để xem và thêm, level 99 để xóa và thay đổi thứ tự</li>
        <li>Definition là nơi đăng ký tất cả các thông tin cần thiết cho 1 học sinh và xây dựng định nghĩa cho autoDocument (sẽ giải thích sau)</li>
    </ul>
    <h2>Thẻ Documents</h2>
    <ul>
        <li>Yêu cầu: nhân viên level 99</li>
        <li>Document là nơi tạo và quản lý các giấy tờ. Trong mỗi giấy tờ(document) sẽ có nhiều định nghĩa, thông tin(definition) và để có thể yêu cầu autoDocument, thông tin trong hồ sơ phải khớp với thông tin đã đăng ký của học sinh</li>
    </ul>
    <h2>Thẻ Files</h2>    
    <ul>
        <li>Yêu Cầu: Nhân viên level 1 có thể xem và thêm mục, nhân viên level 99 có thể xóa</li>
        <li> ALL FILES
            <ul>
                <li>Upload các file phôi(sẽ giải thích sau)</li>
                <li>Download các file đã up</li>
                <li>Max 2mb mỗi file</li>
            </ul>
        </li>
        <li> ALL GROUP FILES
            <ul>
                <li>Sắp đặt các file phôi thành 1 bộ hồ sơ hoàn chỉnh, hoặc 1 phần của 1 bộ hồ sơ</li>
            </ul>
        </li>
    </ul>
    <h2>Thẻ More >> Translate</h2>
    <ul>
        <li>Yêu cầu: Nhân viên level 2</li>
        <li>Hỗ trợ dịch thuật autoDocument</li>
    </ul>
    <h2>Thẻ More >> All employees</h2>
    <ul>
        <li>Yêu cầu: Nhân viên level 99</li>
        <li>Quản lý nhân viên, giao nhiệm vụ</li>
        <li>Nhân viên 99 có thể quản lý nhân viên level 1,2</li>
        <li>Nhân viên level 100 có thể quản lý 99,2,1. Và chỉ có duy nhất 1 nhân viên level 100 người ta gọi đây là sếp</li>
    </ul>
    <hr>
    <strong class="text-danger"><h1>!!! >>AUTO DOCUMENT<< !!!</h1></strong>
    <h2>Phôi là gì?</h2>
    <ul>
        <li>Đây là 1 file phôi. <a href="/storage/file/translate_Test.docx ">download</a></li>
        <li>Đây là trang lưu thông tin để tạo ra file phôi <a href="/definitions">click here</a></li>
        <li>File phôi là nơi hệ thống sẽ điền thông tin của học sinh và những vị trí có định dạng [[[definition]]], và điền bản dịch của thông tin(nếu có) vào [[[definition.nihon]]]</li>
        <li>Nhiều phôi sẽ tạo nên 1 bộ phôi, được đăng ký ở All Group Files</li>        
        <li><strong class="text-danger">ĐIỀU KIỆN ĐỂ ĐƯỢC COI LÀ 1 DEFINITION HỢP LỆ</strong>
            <ul>
                <li>Viết liền, không dấu, chỉ gồm các ký tự a->z A->Z 0->9 và _</li>
                <li>Có 3 cách thường dùng: dùng tiêng anh, họ và tên => ho_va_ten, họ và tên => hoVaTen</li>
                <li>[[[definition.nihon]]] mà thông tin không có bản dịch đã được đăng ký ở Translate thì sẽ chuyển thành "[[[XXX- NO TRANSLATION FOUND -XXX]]]"</li>
                <li class="text-danger"><strong>
                    Giả sử 1 definition là hoVaTen, trong phôi sẽ được viết là [[[hoVaTen]]]. Cả phần [[[hoVaTen]]] phải được gõ tay toàn bộ hoặc copy toàn bộ từ trang web phần ALL DEFINITONS. ĐIỀU NÀY LÀ CỰC KỲ QUAN TRỌNG!. Nên test xem file có được hệ thống nhận diện toàn bộ [[[definition]]] trước khi dùng chính thức
                </strong></li>                
            </ul>
        </li>
    </ul>
    <h2>Auto Document</h2>
    <ul>
        <li>Sau khi tất cả thông tin học sinh đã khớp nhau, nhân viên có thể yêu cầu auto Documnet học sinh này vs 1 bộ phôi</li>
        <li>Mất khoảng 5-10ph để hệ thống hoàn thành</li>
        <li>Sau đó cùng trang yêu cầu, nhân viên có thể tìm thấy file kết quả được nén lại dạng .zip để tải xuống và kiểm tra</li>
        <li>File sẽ được lưu tối đa 8 ngày, nếu cùng học sinh và cùng bộ phôi được yêu cầu, file mới hơn sẽ thay thế file cũ và không thể tải lại file cũ</li>
    </ul>
@endsection
