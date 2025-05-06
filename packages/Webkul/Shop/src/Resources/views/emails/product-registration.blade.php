@component('shop::emails.layout')
    <div style="margin-bottom: 34px;">
        <table>
            <tbody>
                <tr>
                    <td>
                        <strong>Name</strong>
                    </td>
                    <td>
                        {{ $productRegistration['name'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Email</strong>
                    </td>
                    <td>
                        {{ $productRegistration['email'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Phone Number</strong>
                    </td>
                    <td>
                        {{ $productRegistration['contact'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Product Name</strong>
                    </td>
                    <td>
                        {{ $productRegistration['product_name'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Date Of Purchase</strong>
                    </td>
                    <td>
                        {{ $productRegistration['date_of_purchase'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Pin Code</strong>
                    </td>
                    <td>
                        {{ $productRegistration['pin_code'] }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Purchased From</strong>
                    </td>
                    <td>
                        {{ $productRegistration['purchased_from'] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

        <p style="font-size: 16px;color: #384860;line-height: 24px;margin-bottom: 40px">
            @lang('shop::app.emails.contact-us.to')

            <a href="mailto:{{ $productRegistration['email'] }}">{{ $productRegistration['email'] }}</a>,

            @lang('shop::app.emails.contact-us.reply-to-mail')

            @if($productRegistration['contact'])
                @lang('shop::app.emails.contact-us.reach-via-phone')

                <a href="tel:{{ $productRegistration['contact'] }}">{{ $productRegistration['contact'] }}</a>.
            @endif
        </p>
    </p>
@endcomponent
