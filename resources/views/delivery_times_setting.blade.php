@extends('layouts.app')
@section('title', '配信日時設定')

@section('content')

<style>
    .delivery-setting-container {
    padding: 20px;
    background-color: #f9f9f9;
}

.top-controls {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.back-button {
    padding: 8px 16px;
    background-color: #87cefa;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.page-title {
    font-size: 24px;
    margin: 0;
}

.class-title {
    font-size: 18px;
    color: #555;
    margin-left: auto;
}

.delivery-form {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.delivery-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.delivery-row label {
    font-weight: bold;
    font-size: 14px;
}

.delivery-row input[type="date"],
.delivery-row input[type="time"] {
    padding: 6px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.remove-row {
    background-color: #e57373;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
}

.add-button-wrapper {
    text-align: left;
    margin-left: 10px;
}

.add-row {
    background-color: #4fc3f7;
    color: white;
    border: none;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    font-size: 20px;
    cursor: pointer;
}

.submit-button-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.submit-button {
    padding: 12px 40px;
    background-color: #4caf50;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
</style>

<div class="delivery-setting-container">
    <div class="top-controls">
        <a href="{{ route('class.list') }}"> 
        <button class="back-button">戻る</button>
        </a>
        <h1 class="page-title">配信日時設定</h1>
        <h2 class="class-title">{{ $curriculum->title ?? '（授業タイトル未設定）' }}</h2>
    </div>

    <form action="{{ route('delivery.store', $curriculum->id) }}" method="POST" class="delivery-form">
        @csrf
        <div id="delivery-rows">
            @if (!empty($deliveryTimes) && is_array($deliveryTimes) && count($deliveryTimes))
    @foreach ($deliveryTimes as $index => $delivery)
            <div class="delivery-row">
              <label>開始日時:
                  <input type="datetime-local" name="delivery_from[]" value="{{ old("delivery_from.$index") }}">
                     @error("delivery_from.$index")
                         <div class="error" style="color:red;">{{ $message }}</div>
                     @enderror
             </label>

            <label>終了日時:
                <input type="datetime-local" name="delivery_to[]" value="{{ old("delivery_to.$index") }}">
                  @error("delivery_to.$index")
                     <div class="error" style="color:red;">{{ $message }}</div>
                  @enderror
            </label>

    <button type="button" class="remove-row">－</button>
</div>
@endforeach
            @else
            <!-- 初期行 -->
        <div class="delivery-row">
            <label>開始日時:
                <input type="datetime-local" name="delivery_from[]"
                     value="{{ old('delivery_from.0') }}">
                    @error('delivery_from.0')
                      <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
             </label>

            <label>終了日時:
               <input type="datetime-local" name="delivery_to[]"
                     value="{{ old('delivery_to.0') }}">
                   @error('delivery_to.0')
                    <div class="error" style="color:red;">{{ $message }}</div>
                 @enderror
            </label>

        <button type="button" class="remove-row">－</button>
       </div>
            @endif
        </div>

        <div class="add-button-wrapper">
            <button type="button" id="add-row" class="add-row">＋</button>
        </div>

        <div class="submit-button-wrapper">
            <button type="submit" class="submit-button">登録</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deliveryRows = document.getElementById('delivery-rows');
    const addButton = document.getElementById('add-row');

    addButton.addEventListener('click', function () {
        const index = deliveryRows.children.length;

        const row = document.createElement('div');
        row.className = 'delivery-row';
        row.innerHTML = `
            <label>開始日時: <input type="datetime-local" name="delivery_from[]"></label>
            <label>終了日時: <input type="datetime-local" name="delivery_to[]"></label>

            <button type="button" class="remove-row">－</button>
        `;
        deliveryRows.appendChild(row);
    });

    deliveryRows.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const row = e.target.closest('.delivery-row');
            if (deliveryRows.children.length > 1) {
                row.remove();
            }
        }
    });
});
</script>
@endsection
