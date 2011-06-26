<h2>Add cluster</h2>
<form action="/clusters/add" class="tabular
new-issue-form" id="issue-form" method="post">
    <div style="margin:0;padding:0;display:inline">
        <input name="xtk" type="hidden" value=""/>
    </div>
    <div class="box">
        <div id="issue_descr_fields">
            <p>
                <label for="issue_subject">Cluster name<span class="required"> *</span></label><input id="issue_subject" name="cluster[name]" size="80" type="text" value=""/>
            </p>
            <p id="parent_issue">
                <label for="issue_parent_issue_id">Short-key<span class="required"> *</span></label><input id="issue_parent_issue_id" name="cluster[key]" size="16" type="text" />
            </p>
            <p>
                <label for="issue_description">Description</label><textarea accesskey="e" cols="60" id="issue_description" name="cluster[description]" rows="10"></textarea>
            </p>
        </div>
    </div>
    <input name="add" type="submit" value="Add cluster"/>
    <input name="cancel" type="submit" value="Cancel"/>

</form>