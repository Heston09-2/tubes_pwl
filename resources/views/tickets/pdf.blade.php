<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tiket #{{ $ticket->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 text-gray-700 font-sans leading-relaxed">

    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-lg border border-green-700 p-8 mt-12">
        <h1 class="text-4xl font-extrabold text-green-800 uppercase mb-6 text-center drop-shadow-md">Tiket Flows Arcive </h1>

        <div class="flex justify-between bg-green-200 rounded-lg p-5 shadow-inner mb-8 text-green-900 font-semibold text-lg">
            <div class="text-center flex-1 border-r border-green-400">
                <div class="text-sm uppercase tracking-widest mb-1">ID Tiket</div>
                <div>{{ $ticket->id }}</div>
            </div>
            <div class="text-center flex-1 border-r border-green-400">
                <div class="text-sm uppercase tracking-widest mb-1">Total Tiket</div>
                <div>{{ $ticket->quantity }}</div>
            </div>
            <div class="text-center flex-1">
                <div class="text-sm uppercase tracking-widest mb-1">Total Harga</div>
                <div>Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-green-800 mb-4 border-b-2 border-green-700 pb-2">Detail Tiket per Pengunjung</h2>

        <ol class="list-decimal list-inside space-y-6">
            @foreach ($ticket->names as $index => $name)
            <p>-------------------------------------------------------------------------------------------------------------------------------------------------</p>
                <li class="bg-green-100 rounded-lg p-4 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <p><span class="font-semibold text-green-700">Nama:</span> {{ $name }}</p>
                    <p><span class="font-semibold text-green-700">No Tiket:</span> {{ $ticket->id }}-{{ $index + 1 }}</p>
                    <p><span class="font-semibold text-green-700">Berlaku Sampai:</span> {{ $ticket->valid_until->format('d M Y') }}</p>
                    <p><span class="font-semibold text-green-700">Waktu Pembelian:</span> {{ $ticket->created_at->format('d M Y H:i') }}</p>
                    <p>Alamat:Jl.Doktor Mansyur, NO 18, KOTA MEDAN </p>
                    
                </li>
            @endforeach
            <p>-------------------------------------------------------------------------------------------------------------------------------------------------</p>
        </ol>

        <p class="mt-10 text-center text-green-600 italic text-sm">Terima kasih sudah memesan tiket di Flows Arcive . Selamat menikmati koleksi kami!</p>
        <p class="mt-2 text-center text-green-600 italic text-sm">Untuk pertanyaan lebih lanjut, silakan hubungi kami di ArciveMuseum@gmail.com ./p>
    </div>

</body>
</html>
