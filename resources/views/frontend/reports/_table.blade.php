<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">{{ _i('Indicator') }}</th>
      <th scope="col">{{ _i('Exceeding the standard, times') }}</th>
    </tr>
  </thead>
  <tbody>
    @forelse($reportAnswers as $reportAnswer)
    <tr>
      <td>{{ $reportAnswer->question }}</td>
      <td>{{ $reportAnswer->answer }}</td>
    </tr>  
    @empty  
    <tr>
        <td></td>
        <td></td>
    </tr>
    @endforelse
  </tbody>
</table>