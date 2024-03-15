<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h5 class="modal-title" id="title_modal" name="title_modal">Risk Level</h5>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_crud_risk_level" action="javascript:void(0)" method="post"
        enctype="multipart/form-data">
        <div>
          <h6>Description</h6>
        </div>
        <div>
          <h6 class="gray-text" name="description_detail" id="description_detail">
            รอใส่คำอธิบายเพิ่มเติม
          </h6>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="form-group mt-3 col-6">
              <h6>Risk Level</h6>
              <input class="form-control" type="text" name="risklevel" id="risklevel" required></input>
            </div>
          </div>
          <div class="row">
            <div class="form-group mt-3 col-6">
              <h6>Risk Color</h6>
              <input class="form-control" type="color" name="riskcolor" id="riskcolor"></input>
            </div>
            <div class="form-group mt-3 col-6">
              <h6>Text Color</h6>
              <input class="form-control" type="color" name="textcolor" id="textcolor"></input>
            </div>
          </div>
          <div class="row">
            <div class="form-group mt-3 col-6">
              <h6>Min Range</h6>
              <input class="form-control" type="number" name="minranges" id="minranges" min="0"
                oninput="checkInput(this);" required></input>
            </div>
            <div class="form-group mt-3 col-6">
              <h6>Max Range</h6>
              <input class="form-control" type="number" name="maxranges" id="maxranges" min="0"
                oninput="checkInput(this);" required></input>
            </div>
          </div>
          <div class="form-group mt-3">
            <h6>Description</h6>
            <textarea class="form-control" type="text" name="description" id="description" required></textarea>
          </div>
        </div>
        <input type="text" id="url_route" name="url_route" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit" value="Submit">SAVE</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $(".overlay").hide();
  });

  $("#form_crud_risk_level").on('submit', function (e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    const minranges = document.getElementById("minranges");
    const maxranges = document.getElementById("maxranges");
    console.log(minranges.value, maxranges.value);
    if (parseInt(minranges.value) >= parseInt(maxranges.value)) {
      Swal.fire({
        title: "Max Range must be greater than Min Range",
        icon: 'error',
        showConfirmButton: true
      });
    } else {
      action_(urlRouteInput.value, 'form_crud_risk_level');
    }
  });

  function checkInput(input) {
    if (input.value === '0') input.value = ''; // ถ้าค่าเป็นเฉพาะ 0 ไม่ต้องทำอะไร
    if (input.value.startsWith('0')) {
      input.value = input.value.replace(/^0+/, ''); // ลบศูนย์ที่นำหน้าออก
    }
  }

  var elements = document.querySelectorAll('input[type="number"]');

  elements.forEach(function (element) {
    element.addEventListener('input', function () {
      // ตรวจสอบว่าเป็นตัวแรกของข้อความหรือไม่
      if (this.value.startsWith(' ')) {
        // ถ้าเป็นตัวแรก ลบช่องว่าง
        this.value = this.value.trimStart();
      }
      // ลบตัวอักษรพิเศษที่ไม่ต้องการ
      this.value = this.value.replace(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/g, '');
    });
  });
</script>