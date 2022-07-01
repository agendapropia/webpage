let div=$("#tableUsers"),route="/admin/accounts/users/list",structure=[" ","Estado","Nombre","Teléfono","Idioma"];var UserTable=new tableGear(div,route,structure);UserTable.filter.status="",UserTable.refresh(!0);let modalCreateUser=$("#modal-create-user"),formCreateUser=$("form[name=form-create-user]");function CreateUser(){UtilClearFormUi(formCreateUser),queryCreateUser.Send()}let queryCreateUser=new QueryAjax({url:"/admin/accounts/users/create",method:"GET",action:"CreateUserModal",listTable:UserTable});function CreateUserModal(e,s){e&&(LoadSelectUtil(modalCreateUser.find("select[name=gender_id]"),s.data.genders),LoadSelectUtil(modalCreateUser.find("select[name=phone_code]"),s.data.countries),LoadSelectUtil(modalCreateUser.find("select[name=location]"),[{id:"es",name:"Español"},{id:"en",name:"Ingles"}],"es"))}let SendCreateUser=new QueryAjax({form:"form-create-user",action:"UserCreateAction",listTable:UserTable});function UserCreateAction(e,s){e&&(notify(!1,"Usuario creado","Operación realizada exitosamente",2),SendCreateUser.FormClose(),UserTable.refresh())}let modalUpdateUser=$("#modal-update-user"),formUpdateUser=$("form[name=form-update-user]");function UpdateUser(e){UtilClearFormUi(formUpdateUser),queryUpdateUser.var.id=e.id,formUpdateUser.find("input[name=id]").val(e.id),queryUpdateUser.Send()}let queryUpdateUser=new QueryAjax({url:"/admin/accounts/users/update",method:"GET",action:"UpdateUserModal",listTable:UserTable});function UpdateUserModal(e,s){e&&(LoadSelectUtil(modalUpdateUser.find("select[name=gender_id]"),s.data.genders,s.data.user.gender_id),LoadSelectUtil(modalUpdateUser.find("select[name=phone_code]"),s.data.countries,s.data.user.phone_code),LoadSelectUtil(modalUpdateUser.find("select[name=location]"),[{id:"es",name:"Español"},{id:"en",name:"Ingles"}],s.data.user.location),LoadFormInputs(modalUpdateUser,s.data.user))}let SendUserUpdate=new QueryAjax({form:"form-update-user",action:"UserUpdateAction",listTable:UserTable});function UserUpdateAction(e,s){e&&(notify(!1,"Usuario Actualizado","Operación realizada exitosamente",2),SendUserUpdate.FormClose(),UserTable.refresh())}let modalAssignRoles=$("#modal-assign-roles");function AssignRoles(e){modalAssignRoles.find(".name_user").text(e.first_name+" "+e.last_name),assignRolesTable.form.url="/admin/accounts/users/"+e.id+"/roles",SendRolesAssign.url="/admin/accounts/users/"+e.id+"/assign",assignRolesTable.refresh(!1)}let structure_array=[" ","Nombre","Description"];var assignRolesTable=new tableGear($("#assign-roles"),"/admin/accounts/roles/_role_/permissions",structure_array,"selectedDataRoles");function selectedDataRoles(e){assignRolesTable.CheckboxSelect(!1),assignRolesTable.CheckboxArraySelect("role",1)}function SendDataUserRoles(){let e=[],s=[];$.each(assignRolesTable.data_complete.data.data,(function(a,t){1==t.role?-1==jQuery.inArray(t.id,assignRolesTable.checks)&&e.push(t.id):-1!=jQuery.inArray(t.id,assignRolesTable.checks)&&s.push(t.id)})),e.length||s.length?(SendRolesAssign.var.remove=e,SendRolesAssign.var.add=s,SendRolesAssign.Send()):SendRolesAssign.FormClose()}assignRolesTable.tablePaginate=!1,assignRolesTable.filter.row=200;let SendRolesAssign=new QueryAjax({url:"/admin/accounts/roles/_role_/assign",method:"POST",action:"FinishAssignRoles",listTable:UserTable});function FinishAssignRoles(e,s){e&&(notify(!1,"Roles Actualizado","Operación realizada exitosamente",2),SendRolesAssign.FormClose())}let modalStatusUser=$("#modal-status-user");function ChangeStatusAction(e){modalStatusUser.find(".label-user").text(e.first_name+" "+e.last_name);let s=e.status_id?"inactivar":"activar";modalStatusUser.find(".label-query").text(s);let a=e.status_id?'<i class="si si-ban"></i>':'<i class="si si-check"></i>';modalStatusUser.find(".btn-action").html(a+" "+s),modalStatusUser.find(".button-status-send").text(s.toUpperCase()),e.status_id?modalStatusUser.find(".button-status-send").addClass("btn-danger"):modalStatusUser.find(".button-status-send").removeClass("btn-danger"),queryStatusUser.var.id=e.id,queryStatusUser.var.status=e.status_id}function ButtonStatus(){modalStatusUser.find(".overlay").show(),queryStatusUser.Send()}let queryStatusUser=new QueryAjax({url:"/admin/accounts/users/status",method:"PATCH",action:"StatusUserModal",listTable:UserTable});function StatusUserModal(e,s){e&&(modalStatusUser.find(".overlay").hide(),modalStatusUser.modal("hide"),notify(!1,"Usuario Actualizado","Operación realizada exitosamente",2),UserTable.refresh())}const modalFiles=$("#modal-utils-imagen-selections"),divFiles=$(".div-files-class");var filesClass=new updloadS3(divFiles,{url:"/admin/accounts/users/files",typeFile:1,id:1,reload:!1,altFunction:"CloseModalFile",limitFiles:1});function ActionFilesLoad(e){modalFiles.find(".modal-subtitle").text(`(${e.first_name} ${e.last_name})`),filesClass.clear(),filesClass.variables.id=e.id,filesClass.variables.external_id=e.id,filesClass.variables.source_id=1,filesClass.loading.show(),ActionQueryFilesList.var.id=e.id,ActionQueryFilesList.var.type=1,ActionQueryFilesList.Send()}let ActionQueryFilesList=new QueryAjax({url:"/admin/accounts/users/files",method:"GET",action:"FinishActionQueryFilesList"});function FinishActionQueryFilesList(e,s){e&&filesClass.loadData(s.data,ActionQueryFilesList.var.id),filesClass.loading.hide()}function CloseModalFile(){modalFiles.modal("hide"),UserTable.refresh(!0),notify(!1,"Imagen actualizada","Operación realizada exitosamente",2)}
