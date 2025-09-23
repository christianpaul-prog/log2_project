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

    /* custom buttons */
    .custom-btn {
        border: none;
        border-radius: 6px;
        padding: 10px 22px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-left: 10px;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    .custom-btn.accept {
          border: 2px black solid;
        background: #ffffffff; /* green */
        color: #000000ff;
    }
    .custom-btn.accept:hover {
        background: #218838;
        transform: scale(1.05);
    }
    .custom-btn.decline {
             border: 2px black solid;
        background: #ffffffff; /* green */
        color: #000000ff;
    }
    .custom-btn.decline:hover {
        background: #c82333;
        transform: scale(1.05);
    }

    /* button container */
    .terms-actions {
        display: flex;
        justify-content: flex-end; /* laging nasa kanan */
        margin-top: 20px;
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

    <!-- Button container -->
    <div class="terms-actions">
        <a href="{{ route('auth.register') }}" class="custom-btn accept">Accept</a>
        <button type="button" class="custom-btn decline" id="declineBtn">Decline</button>
    </div>
</div>

<script>
    document.getElementById("declineBtn").addEventListener("click", function() {
        alert("You must accept the Terms and Conditions to register. Redirecting to login page.");
        window.location.href = "{{ route('auth.login') }}";
    });
</script>
@endsection
