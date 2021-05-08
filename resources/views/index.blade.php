@extends("master/masterLayout")
@section("content")
<canvas id="CountryRate">
</canvas>
<script>

let chart = document.getElementById('CountryRate').getContext('2d');
let datas ={!! json_encode($datasets, JSON_HEX_TAG) !!};
let label = {!! json_encode($label, JSON_HEX_TAG) !!};
let type = {!! json_encode($type, JSON_HEX_TAG) !!};

let CountryRate = new Chart(chart , {
  type:type,
  data:{
    labels:{!! json_encode($label, JSON_HEX_TAG) !!},
    datasets:[datas]
  },
  options:{
  }
});

</script>
@endsection
