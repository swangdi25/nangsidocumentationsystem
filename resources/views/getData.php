<?php 
if($_GET['t'] == "divisions") { ?>
<select name="division" id="divisionid">
    
<?php 
    $divisions = App\Division::where('agency_id',$_GET['d'])->get(); 
    echo "<option value=''>Select Division</option>";
    foreach($divisions as $division) {
    echo "<option value='$division->id'>$division->division</option>"; }
?>
</select>

<?php  
} //end of gewog.

if($_GET['t'] == "user") { 
    $keyv = $_GET['d'];

    $users = App\User::where('email','LIKE', "%{$keyv}%")->get();
  
       echo "<select name='sendtolist' id='sendto' multiple='multiple' onkeyup='getUsers(this.value)'>";

    foreach($users as $u) {
        echo "<option>$u->email</option>";
    }

    echo "</select>";
}   

if($_GET['t'] == "departments") { 
    //$keyv = $_GET['d'];

    // echo "<select name='dept_id' id='dept' onclick='getDepartment()'>";
    //     echo "<option>.....</option>";
    //     echo "</select>";
    $depts = App\Department::all();
  
       echo "<select name='dept_id' id='dept' onclick='getDepartment()'>";
    foreach($depts as $d) {
        echo "<option value='$d->id'>$d->department</option>";
    }

    echo "</select>";
}   
    
//reserve dispatch number.
if($_GET['t'] == "dispatch") {

        $agency = App\Agency::find(7);
        $agency->dispatch_no = $_GET['d'];
        $agency->save();
}

//close letter.
if($_GET['t'] == "closeletter") {
    $keyv = $_GET['d'];
    $letter = App\Letter::find($keyv);

    //toggle open and close.
    if($letter->status == "closed") {

        //change status.
        $letter->status = "opened";
    } else {  
        
        $letter->status = "closed";
     }

    $letter->save();

}

?>

