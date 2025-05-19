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
@endcomponent
