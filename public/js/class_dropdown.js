var pupil_class = document.getElementById('class')
var subclass = document.getElementById('subclass')
var classGroup = document.getElementById('class_group')

pupil_class.onchange = setDropdown


function setDropdown(){
    var id = pupil_class.value
    if(id === 'upper_primary'){
        var subclasses = [['upper_primary_6', 'Upper Primary 6'], ['upper_primary_5', 'Upper Primary 5'], ['upper_primary_4', 'Upper Primary 4']]
        var class_groups = [['daniel', 'Daniel'],['david', 'David'],['joseph', 'Joseph'],['samuel', 'Samuel']]
        subclass.setAttribute('required','')
        subclass.removeAttribute('disabled')
        classGroup.setAttribute('required','')
        classGroup.removeAttribute('disabled')

    }else if (id === 'lower_primary') {
        var subclasses = [['lower_primary_3', 'Lower Primary 3'],['lower_primary_2', 'Lower Primary 2'],['lower_primary_1', 'Lower Primary 1']]
        var class_groups = [['daniel', 'Daniel'],['david', 'David'],['joseph', 'Joseph'],['samuel', 'Samuel']]
        subclass.setAttribute('required','')
        subclass.removeAttribute('disabled')
        classGroup.setAttribute('required','')
        classGroup.removeAttribute('disabled')

    }else if (id === 'nursery') {
        var subclasses = [['nursery_2', 'Nursery 2'],['nursery_1', 'Nursery 1']]
        var class_groups = [['daniel', 'Daniel'],['david', 'David']]
        subclass.setAttribute('required','')
        subclass.removeAttribute('disabled')
        classGroup.setAttribute('required','')
        classGroup.removeAttribute('disabled')

    } else {
        var subclasses = []
        var class_groups = []
        subclass.setAttribute('disabled','')
        subclass.removeAttribute('required')
        classGroup.setAttribute('disabled','')
        classGroup.removeAttribute('required')
    }

    var subclassOptions = `<option value="" ${old_subclass == "" ? "selected" : "" } hidden="">Select Subclass</option>`
    subclasses.forEach(function(row){
        subclassOptions += `<option value="${row[0]}" ${old_subclass == row[0] ? "selected" : ""}>${row[1]}</option>`
    })

    var classGroupOptions = `<option value="" ${old_class_group == "" ? "selected" : "" } hidden="">Select Class Group</option>`
    class_groups.forEach(function(row){
        classGroupOptions += `<option value="${row[0]}" ${ old_class_group == row[0] ? "selected" : "" }>${row[1]}</option>`
    })

    subclass.innerHTML=subclassOptions
    classGroup.innerHTML=classGroupOptions
}