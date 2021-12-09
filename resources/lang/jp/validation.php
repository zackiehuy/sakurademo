<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを受け入れる必要があります。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:date以降の日付である必要があります。',
    'after_or_equal' => ':attributeは:date以降の日付である必要があります。',
    'alpha' => ':attributeは文字のみを含めることができます。',
    'alpha_dash' => ':attributeは、文字、数字、ダッシュ、およびアンダースコアのみを含めることができます。',
    'alpha_num' => ':attributeは文字と数字のみを含めることができます。',
    'array' => ':attributeは配列である必要があります。',
    'before' => ':attributeは:dateより前の日付である必要があります。',
    'before_or_equal' => ':attributeは:date以前の日付である必要があります。',
    'between' => [
        'numeric' => ':attributeは:min〜:max歳である必要があります。',
        'file' => ':attributeは:min〜:maxキロバイトである必要があります。',
        'string' => ':attributeは:min〜:max文字である必要があります。',
        'array' => ':attributeは:minから:maxのアイテムを持っている必要があります。',
    ],
    'boolean' => ':attributeはtrueまたはfalseである必要があります。',
    'confirmed' => ':attribute確認が一致しません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeは:dateと同じ日付である必要があります。',
    'date_format' => ':attributeが:format形式と一致しません。',
    'different' => ':attributeと:otherは異なっている必要があります。',
    'digits' => ':attributeは:digit桁である必要があります。',
    'digits_between' => ':attributeは:min〜:max桁である必要があります。',
    'dimensions' => ':attributeの画像のサイズが無効です。',
    'distinct' => ':attributeの値が重複しています。',
    'email' => ':attributeは有効なメールアドレスである必要があります。',
    'ends_with' => ':attributeは次のいずれかで終了する必要があります：:value',
    'exists' => '選択した:attributeは無効です。',
    'file' => ':attributeはファイルである必要があります。',
    'filled' => ':attributeには値が必要です。',
    'gt' => [
        'numeric' => ':attributeは:value以上である必要があります。',
        'file' => ':attributeは:valueキロバイト以上である必要があります。',
        'string' => ':attributeは:value文字を超える必要があります。',
        'array' => ':attributeは:value個以上のアイテムを持っている必要があります。',
    ],
    'gte' => [
        'numeric' => ':attributeは:value以上である必要があります。',
        'file' => ':attributeは:valueキロバイト以上である必要があります。',
        'string' => ':attributeは:value文字以上である必要があります。',
        'array' => ':attributeは:value個以上のアイテムを持っている必要があります。',
    ],
    'image' => ':attributeは画像である必要があります。',
    'in' => '選択した:attributeは無効です。',
    'in_array' => ':attributeは:otherに存在しません。',
    'integer' => ':attributeは必須です。',
    'ip' => ':attributeは有効なIPアドレスである必要があります。',
    'ipv4' => ':attributeは有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attributeは有効なIPv6アドレスである必要があります。',
    'json' => ':attributeは有効なJSON文字列である必要があります。',
    'lt' => [
        'numeric' => ':attributeは:value歳未満である必要があります。',
        'file' => ':attributeは:valueキロバイト未満である必要があります。',
        'string' => ':attributeは:value文字未満である必要があります。',
        'array' => ':attributeは:value個未満のアイテムを持っている必要があります。',
    ],
    'lte' => [
        'numeric' => ':attributeは:value以下である必要があります。',
        'file' => ':attributeは:valueキロバイト以下である必要があります。',
        'string' => ':attributeは:value文字以下である必要があります。',
        'array' => ':attributeは:value個を超えるアイテムを持ってはなりません。',
    ],
    'max' => [
        'numeric' => ':attributeは:maxを超えてはなりません。',
        'file' => ':attributeは:maxキロバイトを超えてはなりません。',
        'string' => ':attributeは:max文字を超えてはなりません。',
        'array' => ':attributeは:max個を超えるアイテムを持つことはできません。',
    ],
    'mimes' => ':attributeは、タイプ:valuesのファイルである必要があります。',
    'mimetypes' => ':attributeは、タイプ:valuesのファイルである必要があります。',
    'min' => [
        'numeric' => ':attributeは:min以上である必要があります。',
        'file' => ':attributeは少なくとも:minキロバイトである必要があります。',
        'string' => ':attributeは:min文字以上である必要があります。',
        'array' => ':attributeは少なくとも:min個のアイテムを持っている必要があります。',
    ],
    'not_in' => '選択した:attributeは無効です。',
    'not_regex' => ':attribute形式が無効です。',
    'numeric' => ':attributeは数字である必要があります。',
    'present' => ':attributeが存在する必要があります。',
    'regex' => ':attribute形式が無効です。',
    'required' => ':attributeは必須です。',
    'required_if' => ':otherが:valueの場合、:attributeは必須です。',
    'required_unless' => ':otherが:valuesにない限り、:attributeは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeは必須です。',
    'required_without_all' => ':valuesが存在しない場合、:attributeは必須です。',
    'same' => ':attributeと:otherは一致する必要があります。',
    'size' => [
        'numeric' => ':attributeは:size歳である必要があります。',
        'file' => ':attributeは:sizeキロバイトである必要があります。',
        'string' => ':attributeは:size文字である必要があります。',
        'array' => ':attributeには:size個のアイテムが含まれている必要があります。',
    ],
    'starts_with' => ':attributeは、次のいずれかで開始する必要があります：:values',
    'string' => ':attributeは文字列である必要があります。',
    'timezone' => ':attributeは有効なゾーンである必要があります。',
    'unique' => ':attributeはすでに連れて行かれています。',
    'uploaded' => ':attributeはアップロードに失敗しました。',
    'url' => ':attribute形式が無効です。',
    'uuid' => ':attributeは有効なUUIDである必要があります。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
