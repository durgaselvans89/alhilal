<?php

	interface CriteriaConstants {

		const SELECT_CRITERIA_DESC = "select CriterionPartID, criterionpartshortdescription, CriterionPartDefinition from criterionpart where criterionpartid = ? ";
	
		const SELECT_GUIDANCE = "select GuidancePointDescription from guidancepoint where criterionpartid = ? order by GuidancePointID";
		
	}

?>
