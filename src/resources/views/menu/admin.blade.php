<ul class="collapsible" data-collapsible="expandable">
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
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i>จัดการอาจารย์</div>
        <div class="collapsible-body">
            <ul class="collection">
                <li class="collection-item"><a href="{{ url('/teacher/manage') }}" class="collection-item">จัดการอาจารย์</a>
                </li>
                <li class="collection-item"><a href="{{ url('/teacher/create') }}" class="collection-item">เพิ่มอาจารย์</a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i>จัดการผู้ดูแล</div>
        <div class="collapsible-body">
            <ul class="collection">
                <li class="collection-item"><a href="{{ url('/manager/manage') }}" class="collection-item">จัดการู้ดูแล</a>
                </li>
                <li class="collection-item"><a href="{{ url('/manager/create') }}" class="collection-item">เพิ่มผู้ดูแล</a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="collapsible-header active"><i class="material-icons">filter_drama</i><a href="{{ url('/logout') }}">ออกจากระบบ</a></div>
    </li>
</ul>