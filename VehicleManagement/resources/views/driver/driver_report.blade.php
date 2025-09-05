@extends('layouts.app')
@section('title', 'Drivers Reports')
@section('content')
<style>
   .container-fluid {
           transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
            @keyframes slideUp {
  from {
    transform: translateY(100px);
    opacity: 0;
  }
  to {
    transform: translateY(0);   
    opacity: 1;
  }
}
.slide-up {
  animation: slideUp 0.6s ease-out;
}

</style>
  <div class="container-fluid slide-up my-4">
    <h2 class="mb-4">Issue Report</h2>
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th scope="col">Item #</th>
          <th scope="col">Driver name</th>
          <th scope="col">Location</th>
          <th scope="col">Report</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#101</td>
          <td>Astrid</td>
          <td>Blk 2 Lot36 Champaca street</td>
          <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga animi reiciendis, iure ullam cupiditate eos maxime sequi voluptatibus sed veniam ipsam rem eaque provident ad unde voluptas accusamus harum neque?</td>
          <td>2024-06-01</td>
        </tr>
        <tr>
          <td>#111</td>
          <td>Ramjay</td>
          <td>Blk 2 Lot36 Champaca street</td>
          <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga animi reiciendis, iure ullam cupiditate eos maxime sequi voluptatibus sed veniam ipsam rem eaque provident ad unde voluptas accusamus harum neque?</td>
          <td>2025-20-1</td>
        </tr>
        <tr>
          <td>#111</td>
          <td>Lilay</td>
          <td>Blk 2 Lot36 Champaca street</td>
          <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga animi reiciendis, iure ullam cupiditate eos maxime sequi voluptatibus sed veniam ipsam rem eaque provident ad unde voluptas accusamus harum neque?</td>
          <td>2025-11-7</td>
        </tr>
        <tr>
          <td>#111</td>
          <td>Ramjay</td>
          <td>Blk 2 Lot36 Champaca street</td>
          <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga animi reiciendis, iure ullam cupiditate eos maxime sequi voluptatibus sed veniam ipsam rem eaque provident ad unde voluptas accusamus harum neque?</td>
          <td>2025-05-3</td>
        </tr>
      </tbody>
    </table>
  </div>

@endsection