<!-- Modal -->
 <button type="button" class="btn btn-success mt-3 modalBtn" data-bs-toggle="modal" data-bs-target="#statusModal">
        Open Modal
    </button>
<div class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="">
        <button type="button" class="btn-close float-end pt-3 pe-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
<!--modal css-->