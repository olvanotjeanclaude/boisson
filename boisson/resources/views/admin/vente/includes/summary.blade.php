<table class="table table-striped table-sm">
    <tr>
        <td class="label">TOTAL FACTURE</td>
        <td class="price"><span class="badge badge-primary">{{ formatPrice($sumAmount, 'Ar') }}</span></td>
    </tr>
    <tr>
        <td class="label">OU</td>
        <td class="price">
           <span class="badge badge-primary">{{ formatPrice($sumAmount * 5, 'Fmg') }}</span>
        </td>
    </tr>

    @if ($sumPaid > 0)
        <tr>
            <td class="label">PAYE </td>
            <td class="price"><span class="badge badge-success">{{ formatPrice($sumPaid, 'Ar') }}</span></td>
        </tr>
    @endif

    @if ($reste > 0)
        <tr>
            <td class="label">RESTE A PAYE </td>
            <td class="price"><span class="badge badge-warning">{{ formatPrice($reste, 'Ar') }}</span></td>
        </tr>
    @endif
</table>
