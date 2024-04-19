<!-- resources/views/table_reservation.blade.php -->

@extends('layouts.app')
<x-header/>
<x-navbar/>
<style type="text/css">
 .details_card
        {
            display: flex;
            align-items: center;
            margin: 150px 0px;
        }
        .details_card>span
        {
            float: left;
            font-size: 60px;
        }
        
        .details_card>div
        {
            float: left;
            font-size: 20px;
            margin-left: 20px;
            letter-spacing: 2px
        }
    .table_reservation_section
    {
        max-width: 850px;
        margin: 50px auto;
        min-height: 500px;
    }

    .check_availability_submit
    {
        background: #ffc851;
        color: white;
        border-color: #ffc851;
        font-family: work sans,sans-serif;
    }
    .client_details_tab  .form-control
    {
        background-color: #fff;
        border-radius: 0;
        padding: 25px 10px;
        box-shadow: none;
        border: 2px solid #eee;
    }

    .client_details_tab  .form-control:focus 
    {
        border-color: #ffc851;
        box-shadow: none;
        outline: none;
    }
    .text_header
    {
        margin-bottom: 5px;
        font-size: 18px;
        font-weight: bold;
        line-height: 1.5;
        margin-top: 22px;
        text-transform: capitalize;
    }
    .layer
    {
        height: 100%;
    background: -moz-linear-gradient(top, rgba(45,45,45,0.4) 0%, rgba(45,45,45,0.9) 100%);
background: -webkit-linear-gradient(top, rgba(45,45,45,0.4) 0%, rgba(45,45,45,0.9) 100%);
background: linear-gradient(to bottom, rgba(45,45,45,0.4) 0%, rgba(45,45,45,0.9) 100%);
    }

</style>

@section('content')
    <div class="table_reservation_section">
        <div class="container">
            @if (isset($reservationSuccess))
                <div class="alert alert-success">
                    Great! Your Reservation has been created successfully.
                </div>
            @endif

            <div class="text_header">
                <span>1. Select Date & Time</span>
            </div>
            <form method="POST" action="{{ url('checkAvailability') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="reservation_date">Date</label>
                            <input type="date" min="{{ isset($reservation_date) ? $reservation_date : date('Y-m-d', strtotime("+1 day")) }}" value="{{ isset($reservation_date) ? $reservation_date : date('Y-m-d', strtotime("+1 day")) }}" class="form-control" name="reservation_date">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="reservation_time">Time</label>
                            <input type="time" value="{{ isset($reservation_time) ? $reservation_time : date('H:i') }}" class="form-control" name="reservation_time">
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="number_of_guests">How many people?</label>
                            <select class="form-control" name="number_of_guests">
                                <option value="1" {{ isset($number_of_guests) && $number_of_guests == '1' ? 'selected' : '' }}>One person</option>
                                <option value="2" {{ isset($number_of_guests) && $number_of_guests == '2' ? 'selected' : '' }}>Two people</option>
                                <option value="3" {{ isset($number_of_guests) && $number_of_guests == '3' ? 'selected' : '' }}>Three people</option>
                                <option value="4" {{ isset($number_of_guests) && $number_of_guests == '4' ? 'selected' : '' }}>Four people</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="check_availability" style="visibility: hidden;">Check Availability</label>
                            <input type="submit" class="form-control check_availability_submit" name="check_availability_submit">
                        </div>
                    </div>
                </div>
            </form>

            <!-- CHECKING AVAILABILITY OF TABLES -->

            @isset($availableTables)
                @if (isset($failed))
                    <div class="error_div">
                        <span class="error_message" style="font-size: 16px">{{ $failed }}</span>
                    </div>
                @else
                    <div class="text_header">
                        <span>2. Client details</span>
                    </div>
                    <form method="POST" action="{{ url('makeReservation') }}">
                        @csrf
                        <input type="hidden" name="selected_date" value="{{ $selected_date }}">
                        <input type="hidden" name="selected_time" value="{{ $selected_time }}">
                        <input type="hidden" name="number_of_guests" value="{{ $number_of_guests }}">
                        <input type="hidden" name="table_id" value="{{ $availableTables->first()->table_id }}">
                        <div class="client_details_tab">
                            <div class="form-group colum-row row">
                                <div class="col-sm-12">
                                    <input type="text" name="client_full_name" id="client_full_name" class="form-control" placeholder="Full name">
                                    <div class="invalid-feedback" id="required_fname">Invalid Name!</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="email" name="client_email" id="client_email" class="form-control" placeholder="E-mail">
                                    <div class="invalid-feedback" id="required_email">Invalid E-mail!</div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text"  name="client_phone_number" id="client_phone_number" class="form-control" placeholder="Phone number">
                                    <div class="invalid-feedback" id="required_phone">Invalid Phone number!</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit_table_reservation_form" class="btn btn-info" value="Make a Reservation">
                        </div>
                    </form>
                    @if (isset($success))
                    <div class="error_div">
                        <span class="error_message" style="font-size: 16px">{{ $success }}</span>
                    </div>
                    @endif
                @endif
            @endisset
        </div>
    </div>
    <x-footer/>
@endsection

