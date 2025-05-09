<div class="modal fade" id="negosiasiModal{{ $pesanan->id }}" tabindex="-1"
    aria-labelledby="negosiasiLabel{{ $pesanan->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="negosiasiLabel{{ $pesanan->id }}">Negosiasi Pesanan #{{ $pesanan->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <!-- Riwayat pesan -->
                <div class="mb-3" style="max-height: 200px; overflow-y: auto;">
                    @foreach ($pesanan->negosiasi as $n)
                        <div class="mb-2">
                            <strong>{{ $n->id_user == auth()->id() ? 'Anda' : 'Admin' }}</strong>:
                            <span>{{ $n->pesan }}</span><br>
                            <small class="text-muted">{{ $n->created_at->format('d-m-Y H:i') }}</small>
                        </div>
                    @endforeach
                </div>

                <!-- Form kirim pesan -->
                <form action="{{ route('negosiasi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_user" value="{{ auth()->id() }}">
                    <input type="hidden" name="id_pelanggan" value="{{ $pesanan->id_pelanggan }}">
                    <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
                    <textarea name="pesan" class="form-control mb-2" placeholder="Ketik pesan..." required></textarea>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
