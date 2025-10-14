
@php
    $bgColor = $type === 'error' ? '#f8d7da' : '#d4edda';      
    $borderColor = $type === 'error' ? '#f5c6cb' : '#c3e6cb'; 
    $textColor = $type === 'error' ? '#721c24' : '#155724';    
@endphp

<div style="
    background-color: {{ $bgColor }};
    border: 1px solid {{ $borderColor }};
    color: {{ $textColor }};
    border-radius: 8px;
    padding: 12px 18px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 500;
">
    <strong>{{ ucfirst($type) }}:</strong> {{ $message }}
</div>
