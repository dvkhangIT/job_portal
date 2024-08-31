<div class="card account-nav mb-lg-0 mb-4 border-0 shadow">
  <div class="card-body p-0">
    <ul class="list-group list-group-flush">
      <li class="list-group-item d-flex justify-content-between p-3">
        <a href="{{ route("admin.users") }}">Users</a>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <a href="{{ route("admin.jobs") }}">Jobs</a>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <a href="{{ route("admin.jobApplications") }}">Jobs Applications</a>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
        <a href="{{ route("account.logout") }}">Logout</a>
      </li>
    </ul>
  </div>
</div>
