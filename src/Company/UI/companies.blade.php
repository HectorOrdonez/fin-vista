@foreach($companies as $company)
    <p>
        <div>{{ $company->id }}</div>
        <div>{{ $company->name }}</div>
        <div>{{ $company->description }}</div>
        <div>{{ $company->address }}</div>
    </p>
@endforeach
