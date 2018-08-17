<?php


	interface CreateWorkflowConstants{
	
		const CREATE_NEW_STAGE = "insert into workflow(wo_updated_date, zone, region, sub_region, location, cust_name, cust_addr, contact_name, contact_number, wo_no, wo_date, provider_name, type_of_rf, tat_begins_date, city_type, type_of_wo, feasible_assigned_date, feasible_eng_name, feasible_tech_name, assigned_emp_code_eng, assigned_emp_code_tech, manned, distance_gcl, feasible_issue, feasible_escalated_date, issue_bucket, feasible_resolved_date, feasible_resolved_remarks, issue_resolve_bucket, pending, pending_bucket, pending_remarks, phy_inst_assigned_date, install_eng_name, install_tech_name, phy_emp_code_eng, phy_emp_code_tech, phy_manned, phy_distance_gcl, phy_current_status, phy_inst_completed_date, rf_assigned_date, rf_install_eng_name, rf_install_tech_name, rf_emp_code_eng, rf_emp_code_tech, rf_inst_completed_date, rf_current_status, stability_start_date, stability_current_status, stability_end_date, at_assigned_date, at_current_status, at_emp_code_eng, at_emp_code_tech, at_completed_date, convertor_installed, date_of_convertor, e_current_status,e_emp_code_eng, e_emp_code_tech, pcr_current_status, qc_verified, bill_invoice_num, bill_invoice_date, stage) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	
	
		const UPDATE_ASSIGNED_STAGE = "update workflow set feasible_assigned_date = ?,feasible_eng_name = ?, feasible_tech_name = ?, assigned_emp_code_eng = ?,assigned_emp_code_tech = ?,manned = ?,distance_gcl = ? , stage = ? where order_id = ?;";


		const UPDATE_ISSUE_STAGE = "update workflow set feasible_issue= ?,feasible_escalated_date=?, issue_bucket = ?, stage = ? where order_id = ?;";
	
		const UPDATE_ISSUE_RESOLVED_STAGE = "update workflow set feasible_resolved_date = ?,feasible_resolved_remarks = ?,issue_resolve_bucket = ?, stage = ? where order_id = ?;";
	
		const UPDATE_PENDING_STAGE = "update workflow set pending = ? , pending_bucket=?, pending_remarks = ?, stage = ? where order_id = ?; ";
	
		const UPDATE_PHY_INSTALLATION_STAGE = "update workflow set phy_inst_assigned_date = ?, install_eng_name = ?, install_tech_name = ?, phy_emp_code_eng = ?, phy_emp_code_tech=?, phy_manned= ?,   phy_distance_gcl = ?, phy_current_status = ?, phy_inst_completed_date = ?, stage = ? where order_id = ?;"; 
		
		const UPDATE_RF_INSTALLATION_STAGE = "update workflow set rf_assigned_date = ?, rf_install_eng_name = ?, rf_install_tech_name = ?, rf_emp_code_eng = ?, rf_emp_code_tech = ?, rf_inst_completed_date = ?, rf_current_status = ?, stage = ? where order_id = ?;";
		
		
		const UPDATE_STABILITY_STAGE = " update workflow set stability_start_date = ?, stability_current_status= ?, stability_end_date = ?, stage = ? where order_id = ?; ";
	
	
		const UPDATE_AT_STAGE = "update workflow set at_assigned_date = ?,at_emp_code_eng = ?,at_emp_code_tech = ?, stage = ? where order_id = ?; ";
		
		
		const UPDATE_E_STAGE = "update workflow set convertor_installed = ?, date_of_convertor = ?, e_current_status = ?, e_emp_code_eng =?, e_emp_code_tech =?, stage = ? where order_id = ?;";


		const UPDATE_PCR_STAGE = "update workflow set pcr_current_status = ?, stage = ? where order_id = ?;";

		const UPDATE_QC_STAGE = "update workflow set qc_verified = ?, stage = ? where order_id = ?;";

		
		const UPDATE_BILLING_STAGE = "update workflow set bill_invoice_num = ?, bill_invoice_date = ? , stage = ? where order_id = ? "; 
		 
	}
?>
