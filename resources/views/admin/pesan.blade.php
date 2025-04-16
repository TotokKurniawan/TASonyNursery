@extends('layoutadmin.app')

@section('content')
    @include('layoutadmin.navbar')

    <!-- Tampilan Fitur Berbalas Pesan -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3>Fitur Berbalas Pesan</h3>

                <!-- Pencarian atau Dropdown Pelanggan -->
                <div class="form-group">
                    <select id="customer" class="form-control" onchange="loadMessages(this.value)">
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" data-name="{{ $customer->name }}">{{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tampilan Nama Pelanggan dan Pesan -->
                <div id="messages-container" style="display: none;">
                    <div class="card mt-3">
                        <div class="card-body">
                            <!-- Menampilkan Nama Pelanggan -->
                            <div class="d-flex justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <strong class="mr-3">Nama Pelanggan:</strong>
                                    <strong style="margin-left: 8px" id="customer-name"></strong>
                                </div>
                            </div>

                            <!-- Daftar Pesan -->
                            <div id="message-list" class="messages-container">
                                <p>pesan</p>
                            </div>

                            <!-- Form untuk Membalas Pesan -->
                            <form action="" method="POST" class="mt-3" id="reply-form" style="display: block;">
                                @csrf
                                <input type="hidden" name="customer_id" id="customer-id">
                                <div class="form-group">
                                    <label for="message">Balas Pesan:</label>
                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Tulis balasan Anda di sini..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Kirim Balasan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function loadMessages(customerId) {
            const customerSelect = document.getElementById('customer');
            const customerName = customerSelect.options[customerSelect.selectedIndex].getAttribute('data-name');

            document.getElementById('customer-name').textContent = customerName;

            if (customerId) {
                document.getElementById('messages-container').style.display = 'block';
                document.getElementById('customer-id').value = customerId;

                fetch(`/admin/messages/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        const messageList = document.getElementById('message-list');
                        messageList.innerHTML = '';

                        data.messages.forEach(message => {
                            const messageItem = document.createElement('div');
                            messageItem.classList.add('message-item', 'mb-3');
                            messageItem.innerHTML = `
                            <div class="d-flex justify-content-${message.sender_id === {{ auth()->id() }} ? 'end' : 'start'}">
                                <strong>${message.sender_id === {{ auth()->id() }} ? 'Anda' : data.customer.name}:</strong>
                            </div>
                            <p class="ml-4">${message.message}</p>
                        `;
                            messageList.appendChild(messageItem);
                        });

                        document.getElementById('reply-form').style.display = 'block';
                    });
            } else {
                document.getElementById('messages-container').style.display = 'none';
            }
        }

        document.getElementById('reply-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const customerId = document.getElementById('customer-id').value;
            const messageInput = document.getElementById('message');
            const message = messageInput.value;

            fetch('/admin/messages/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        customer_id: customerId,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageInput.value = '';
                        loadMessages(customerId);
                    }
                });
        });
    </script>
@endsection
