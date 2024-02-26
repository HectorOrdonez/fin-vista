<div>
    <h2>Company Listing</h2>
    @foreach($companies as $company)
        <div class="block">
            <div>{{ $company['id'] }}</div>
            <div>{{ $company['name'] }}</div>
            <div>{{ $company['description'] }}</div>
            <div>{{ $company['address'] }}</div>
        </div>
    @endforeach
</div>
