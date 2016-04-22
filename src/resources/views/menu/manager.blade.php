<ul class="collapsible" data-collapsible="expandable">
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i><a
                    href="{{ url('/payment/wait') }}">รายการแจ้งชำระเงิน</a></div>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i><a
                    href="{{ url('/manager/teacher') }}">ดูตารางสอน</a></div>
    </li>
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i>จัดการคอร์สเรียน
        </div>
        <div class="collapsible-body">
            <ul class="collection">
                <li class="collection-item"><a href="{{ url('/course/manage') }}" class="collection-item">จัดการคอร์สเรียน</a></li>
                <li class="collection-item"><a href="{{ url('/course/create') }}" class="collection-item">เพิ่มคอร์สเรียน</a></li>
            </ul>
        </div>
    </li>
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i>จัดการห้องเรียน
        </div>
        <div class="collapsible-body">
            <ul class="collection">
                <li class="collection-item"><a href="{{ url('/room/manage') }}" class="collection-item">จัดการห้องเรียน</a></li>
                <li class="collection-item"><a href="{{ url('/room/create') }}" class="collection-item">เพิ่มห้องเรียน</a></li>
            </ul>
        </div>
    </li>
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i>จัดการผู้เรียน</div>
        <div class="collapsible-body">
            <ul class="collection">
                <li class="collection-item"><a href="{{ url('/member/manage') }}" class="collection-item">จัดการผู้เรียน</a>
                </li>
                <li class="collection-item"><a href="{{ url('/member/create') }}" class="collection-item">เพิ่มผู้เรียน</a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i><a
                    href="{{ url('/logout') }}">ออกจากระบบ</a></div>
    </li>
</ul>