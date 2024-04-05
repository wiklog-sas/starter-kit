@props([
  'semaines' => $semaines,
  'disabled' => bool_val($disabled)
])

<div class="row">

  @for ($annee = 0; $annee < 2; $annee++)

    <div class="col-6">
      <table>
        <tr>
          <th colspan="12">{{ date('Y') + $annee }}</th>
        </tr>
        <tr>
          <td style="vertical-align:top">

            <table>

              @php
                $jour = \Carbon\Carbon::parse(date('Y') + $annee . '-01-01');
                $moisEnCours = -1;
                $semaineEnCours = -1;
              @endphp

              @for ($j = 0; $j < 363; $j++)
                @php
                  $jour = $jour->addDay();
                  $mois = $jour->isoFormat('MMM');
                  $semaine = $jour->isoFormat('WW');
                  $value = $jour->isoFormat('YWW');
                @endphp

                @if ($moisEnCours != $mois)
                  @if ($mois != 1)
                      </table>
                    </td>
                  @endif
                  @if ($mois != 12)
                    <td style="vertical-align:top">
                      <table>
                  @endif
                  
                  <tr>
                    <th> {{ Str::of($mois)->ucfirst()->limit(3, '') }}</th>
                  </tr>
                  @php
                    $moisEnCours = $mois;
                  @endphp

                @endif

                @if ($mois === 'janv.' && $semaine > 50)
                  @continue
                @endif

                @if ($semaineEnCours != $semaine)
                  <tr>
                    <td>
                      <input type="checkbox" name="semaines[]" id="{{ $value }}" class="btn-check week {{ $disabled || $jour < \Carbon\Carbon::now() ? 'disabled' : '' }}" value="{{ $value }}" 
                        {{ in_array($value, $semaines) ? 'checked' : '' }} {{ $disabled || $jour < \Carbon\Carbon::now() ? 'readonly' : '' }} autocomplete="off">
                      <label class="btn btn-sm btn-outline-primary w-100" for="{{ $value }}"><span class="small">{{ $semaine }}</span></label><br>
                    </td>
                  </tr>
                @endif
                @php
                  $semaineEnCours = $semaine;
                @endphp
              @endfor
              
            </table>
          </td>

        </tr>
      </table>
    </div>
  @endfor

</div>