<!-- ===== SUPPRIMER UN TYPE ===== -->
<div class="screen_form_supptype">
    <span class="supp_title_type">Supprimer un des types inutilisé:</span>
    <div class="add_type">
        <ul class="addmatos_type">
            @if(empty($tri_types))
                <span>Aucun type est inutilisé.</span>
            @else
            @foreach($types as $type)
                @foreach($tri_types as $tri_type)
                    @if($type->id == $tri_type['id'])
                        <li>{{$type->nom}} <a class="delete" style="color: #fff; text-transform: none" href="/remove_type/{{$type->id}}"><i class="fa fa-trash"></i></a></li><br/>
                    @endif
                @endforeach
            @endforeach
            @endif
        </ul>
    </div>
</div>


