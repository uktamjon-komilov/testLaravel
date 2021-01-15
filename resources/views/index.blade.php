@extends('layouts.layout')

@section('content')
<div class="container mt-5 p-5 border border-3" style="width: 550px;">
    @if(isset($message) && $message != '')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @php echo $message; @endphp
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="" method="post">
        @csrf
        <h5>You pay</h5>
        <div class="input-group">
            <select class="form-select" id="inputGroupSelect02" name="firstCur">
            @php $flag = true; @endphp
            @foreach ($currencies as $cKey => $cVal)
                @if(isset($from) and $flag)
                    <option value="@php echo $from; @endphp" selected>@php  echo $from; @endphp</option>
                    @php $flag = false; @endphp
                @else
                    <option value="@php echo $cKey; @endphp">@php echo $cKey; @endphp</option>
                @endif
            @endforeach
            </select>
            <input type="number" class="form-control" placeholder="First Currency" name="firstCurrency"
                aria-describedby="basic-addon1" value=
                @isset($values)
                    @php
                        echo floatval($fromVal);
                    @endphp
                @endisset>
        </div>
        <div class="input-group my-5">
            <span class="input-group-text" id="basic-addon1">Exchange rate</span>
            <input type="number" class="form-control" placeholder="Exchange rate" aria-label="Username"
                aria-describedby="basic-addon1" value=
                @isset($values)
                    @foreach ($values as $vKey => $vVal)
                        @if ($from == 'USD' && $vKey == $from.$to)
                            @php
                                echo floatval($vVal);
                            @endphp
                        @else
                            @php
                                $idTo = 'USD'.$to;
                                $idFrom = 'USD'.$from;
                                echo floatval($values->$idTo) / floatval($values->$idFrom);
                            @endphp
                        @endif
                    @endforeach
                @endisset
                readonly>
        </div>
        <h5>Go Media will get</h5>
        <div class="input-group">
            <select class="form-select" id="inputGroupSelect02" name="secondCur">
            @php $flag = true; @endphp
            @foreach ($currencies as $cKey => $cVal)
                @if(isset($to) and $flag)
                    <option value="@php echo $to; @endphp" selected>@php echo $to; @endphp</option>
                    @php $flag = false; @endphp
                @else
                    <option value="@php echo $cKey; @endphp">@php echo $cKey; @endphp</option>
                @endif
            @endforeach
            </select>
            <input type="number" class="form-control" placeholder="Second Currency" name="secondCurrency"
                aria-describedby="basic-addon1" value=
                @isset($values)
                    @foreach ($values as $vKey => $vVal)
                        @if ($from == 'USD' && $vKey == $from.$to)
                            @php
                                echo floatval($vVal);
                            @endphp
                        @else
                            @php
                                $idTo = 'USD'.$to;
                                $idFrom = 'USD'.$from;
                                echo $fromVal * floatval($values->$idTo) / floatval($values->$idFrom);
                            @endphp
                        @endif
                    @endforeach
                @endisset readonly>
        </div>
        <input type="submit" class="btn btn-info mt-4" value="Calculate" style="display: block; width: 100%; font-weight: bold;">
    </form>
</div>
@endsection