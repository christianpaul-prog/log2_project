@extends('layouts.auth')
@section('title', 'Terms and Conditions')
@section('content')
<style>
    .terms-container {
        max-width: 600px;
        margin: 50px auto;
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        animation: fadeIn 0.5s ease-in-out;
    }
    .terms-container h2 {
        text-align: center;
        font-weight: 600;
        color: #2c3e50;
    }
    .terms-container p, 
    .terms-container li {
        text-align: justify;
        line-height: 1.6;
        color: #444;
    }
    .terms-container ul {
        margin-top: 15px;
        padding-left: 20px;
    }
    .terms-container .btn {
        border-radius: 8px;
        padding: 10px 20px;
        margin: 0 5px;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="terms-container">
    <h2>Terms and Conditions</h2>
    <p class="mt-3">
        By creating an account and using this system, you agree to the following Terms and Conditions:
    </p>
<ul>
    <li><strong>Driver & User Responsibility:</strong> You are responsible for ensuring that your account is used properly and that all trips, vehicle reservations, and reports entered into the system are accurate and lawful.</li>
    
    <li><strong>Fleet Usage:</strong> The fleet vehicles must only be used for official and authorized transportation purposes. Unauthorized trips, reckless driving, or misuse of vehicles are strictly prohibited.</li>
    
    <li><strong>Maintenance & Safety:</strong> Users must promptly report any vehicle issues, accidents, or required maintenance. Vehicles should not be dispatched if deemed unsafe.</li>
    
    <li><strong>Data Privacy:</strong> Trip logs, fuel consumption, driver records, and vehicle data collected through this system will be stored securely and used only for operational and reporting purposes.</li>
    
    <li><strong>Accuracy of Records:</strong> All information regarding trips, expenses, and reports must be complete and truthful. Any falsification may result in disciplinary action.</li>
    
    <li><strong>Termination of Access:</strong> The administrator reserves the right to suspend or revoke system access and fleet privileges if these Terms and Conditions are violated.</li>
</ul>

<p>
    By continuing to register and use the Fleet Transportation System, you acknowledge that you have read, understood, and agreed to comply with these Terms and Conditions.  
    If you do not agree, you must refrain from registering or using the system.
</p>


    <div class="text-center mt-4">
    <a href="{{ route('auth.register') }}" class="btn btn-success me-2">Accept</a>
    <button type="button" class="btn btn-danger" id="declineBtn">Decline</button>
</div>



</div>
<script>
    document.getElementById("declineBtn").addEventListener("click", function() {
        alert("You must accept the Terms and Conditions to register. Redirecting to login page.");
        window.location.href = "{{ route('auth.login') }}";
    });
</script>
@endsection
