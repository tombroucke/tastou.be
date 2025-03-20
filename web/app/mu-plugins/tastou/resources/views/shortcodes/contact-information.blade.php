@if (!$property)
  {!! TastouContactInformation::formattedAddress() !!}
  {!! TastouContactInformation::formattedPhoneEmail() !!}
@else
  @if ($property == 'address')
    {!! TastouContactInformation::formattedAddress() !!}
  @endif
  @if ($property == 'phone' && TastouContactInformation::phone())
    {!! TastouContactInformation::formattedPhone() !!}
  @endif
  @if ($property == 'email' && TastouContactInformation::email())
    {!! TastouContactInformation::formattedEmail() !!}
  @endif
  @if ($property == 'vat_number' && TastouContactInformation::vatNumber())
    {!! TastouContactInformation::vatNumber() !!}
  @endif
  @if ($property == 'bank_account_number' && TastouContactInformation::bankAccountNumber())
    {!! TastouContactInformation::bankAccountNumber() !!}
  @endif
@endif
