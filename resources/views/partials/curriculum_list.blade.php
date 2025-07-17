@foreach ($curriculums as $curriculum)
<div class="curriculum-card">
    <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="thumbnail">
    <h2 class="curriculum-title">{{ $curriculum->title }}</h2>

    @foreach ($curriculum->deliveryTimes as $time)
        <p class="delivery-time">
            {{ \Carbon\Carbon::parse($time->delivery_from)->format('Y/m/d H:i') }}
            〜
            {{ \Carbon\Carbon::parse($time->delivery_to)->format('Y/m/d H:i') }}
        </p>
    @endforeach

    <div class="card-buttons">
        <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="edit-button">授業内容編集</a>
        <a href="{{ route('delivery.edit', $curriculum->id) }}" class="edit-button secondary">配信内容編集</a>
    </div>
</div>
@endforeach