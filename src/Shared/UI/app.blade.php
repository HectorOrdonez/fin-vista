<html lang="en">
<head>
    <title>Fin-Vista</title>

    <livewire:styles/>
</head>
<body>
<h1>App Layout</h1>

<x-components.flash></x-components.flash>
<x-components.nav></x-components.nav>

{{ $slot }}

<livewire:scripts/>
</body>
</html>
