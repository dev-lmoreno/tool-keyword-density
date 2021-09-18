@extends('layouts.master')

@section ('scripts')
    <script>
        $('#keywordDensityInputForm').on('submit', function (e) {
            e.preventDefault();
            let kdInput = $('#keywordDensityInput').val();
            console.log(kdInput)
            if (kdInput !== "") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/tool/calculate-and-get-density",
                    data: {'keywordInput': kdInput},
                    success: function (response) {
   
                        if (response.length > 0) {
                            let html = "<table class='table'><tbody><thead>";
                            html += "<th>Keyword</th>";
                            html += "<th>Count</th>";
                            html += "<th>Density</th>";
                            html += "</thead><tbody>";

                            for (let i = 0; i < response.length; i++) {
                                html += "<tr><td>"+response[i].keyword+"</td>";
                                html += "<td>"+response[i].count+"</td>";
                                html += "<td>"+response[i].density+"%</td></tr>";
                            }

                            html += "</tbody></table>";

                            $('#keywordDensityInputForm').after(html);
                        }
                    },
                });
            }
        })
    </script>
@endsection

@section('content')
<form id="keywordDensityInputForm">
    <div class="form-group">
        <label for="keywordDensityInput">HTML or Text</label>
        <textarea class="form-control" id="keywordDensityInput" rows="8"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Get Keyword Densities</button>
</form>
@endsection



