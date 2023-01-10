<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <label for="ip" class="col-sm-3 col-form-label">IP (маска)</label>
            <div class="col-md-8">
                <input type="text" name="ip" class="form-control" id="ip" value="{{ $ip->ip ?? '' }}" placeholder="192.168.*.*" pattern='\d{1,3}\.\d{1,3}\.\*\.\*'>
            </div>                                    
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group row">
            <label for="start_ip" class="col-sm-3 col-form-label">Диапазон IP</label>
            <div class="col-md-4">
                <input type="text" name="start_ip" class="form-control" id="start_ip" value="{{ $ip->start_ip ?? '' }}" placeholder="192.168.25.10" pattern='\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}'>
            </div>                      
            <div class="col-md-4">
                <input type="text" name="stop_ip" class="form-control" id="stop_ip" value="{{ $ip->stop_ip ?? '' }}" placeholder="192.168.25.255" pattern='\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}'>
            </div>               
        </div>
    </div>
    
</div>
   
<div class="edit_form_bottom_menu">
    <div class="row align-middle">        
            <div class="input-group mb-3 col-md-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">id</span>
                </div>
                <input type="text" class="form-control" name="id" disabled aria-label="Username" aria-describedby="basic-addon1" value="{{ $manufacture->id ?? '' }}">
            </div>
            {{-- <div class="input-group mb-3 col-md-8">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">slug</span>
                </div>
                <input type="text" class="form-control" name="slug" readonly aria-label="Username" aria-describedby="basic-addon1" value="{{ $manufacture->slug ?? '' }}">
            </div> --}}
            <div class="mb-3 col-md-2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
                    
        </div>
</div>   