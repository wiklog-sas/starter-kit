@props(['property', 'old', 'required' => false, 'pivot' => false])

<input type="hidden" name="{{ $property }}" id="{{ $property }}" {{ bool_val($required) ? 'required' : '' }}
  value="{{ old(
      $property,
      $entity != null
          ? ($itemPivot == null
              ? ($itemProperty == null
                  ? $entity->$property
                  : $entity->$itemProperty)
              : ($pivot
                  ? $entity->pivot->$itemPivot
                  : $entity->$itemPivot))
          : $old ?? '',
  ) }}" />
