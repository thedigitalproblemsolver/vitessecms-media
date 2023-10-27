<?php

declare(strict_types=1);

namespace VitesseCms\Media\Fields;

use VitesseCms\Database\AbstractCollection;
use VitesseCms\Datafield\AbstractField;
use VitesseCms\Datafield\Models\Datafield;
use VitesseCms\Form\AbstractForm;
use VitesseCms\Form\Models\Attributes;

final class EmbeddedMedia extends AbstractField
{
    public function buildItemFormElement(
        AbstractForm $form,
        Datafield $datafield,
        Attributes $attributes,
        AbstractCollection $data = null
    ) {
        $form->addUrl(
            $datafield->getNameField(),
            $datafield->getCallingName(),
            $attributes
        );
    }
}
