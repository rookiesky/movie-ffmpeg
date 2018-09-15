<div class="card rounded-0" style="width: 18rem;">
    <div class="card-header rounded-0 font-weight-bold" style="letter-spacing: 6px;">
        欄目
    </div>
    <ul class="list-group list-group-flush">
        <a href="/member">
            <li class="list-group-item rounded-0 @if(isset($userMenus)){{ $userMenus }} @endif">會員專區<span class="oi oi-chevron-right float-right"></span></li>
        </a>
        <a href="/member/user-info">
            <li class="list-group-item rounded-0 @if(isset($userInfoMenu)){{ $userInfoMenu }} @endif">修改個人資料<span class="oi oi-chevron-right float-right"></span></li>
        </a>
        <a href="">
            <li class="list-group-item rounded-0">儲值點數／點數兌換<span class="oi oi-chevron-right float-right"></span></li>
        </a>
        <a href="">
            <li class="list-group-item rounded-0">消費紀錄<span class="oi oi-chevron-right float-right"></span></li>
        </a>
        <a href="/member/collects">
            <li class="list-group-item rounded-0 @if(isset($collectMenu)){{ $collectMenu }} @endif">收藏影片<span class="oi oi-chevron-right float-right"></span></li>
        </a>
    </ul>
</div>