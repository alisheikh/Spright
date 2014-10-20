        <div id="chooseLocation">
           <div class="form-group"><?php
            echo $this->Form->input('Site.code',array('type' => 'select','class' => 'form-control','label'=>'Site','options'=>$sites, 'selected' => $this->data['Site']['id'])); ?>
            </div>

            <div class="form-group"><?php
                echo $this->Form->input('Building.code',array('type' => 'select','class' => 'form-control','label'=>'Building','options'=>$buildings, 'selected' => $this->data['Building']['id'])); ?>
                </div>

                <div class="form-group"><?php
                    echo $this->Form->input('Floor.code',array('type' => 'select','class' => 'form-control','label'=>'Floor','options'=>$floors, 'selected' => $this->data['Floor']['id'])); ?>
                    </div>
                    <div class="form-group"><?php
                        echo $this->Form->input('Room.code',array('type' => 'select','class' => 'form-control','label'=>'Room','options'=>$rooms, 'selected' => $this->data['Room']['id'])); ?>
                    </div>
         </div>