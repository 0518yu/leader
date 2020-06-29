<!-- BEGIN PhpHeader --><?php
namespace {NameSpace};

use App\pithy\BaseBean;
/**
 * Class {ClassName}
 * Bean class for object oriented management of the MySQL table {TableName}
 *
 * Comment of the managed table {TableName}: {TableComment}.
 *
 * @extends {ClassParent}
 * @filesource {ClassFileName}
 * @category MySql Database Bean Class
 * @package {ClassPackageName}
 * @author {AuthorName} <{AuthorEmail}>
 * @copyright (c) 2020 {AuthorName} <{AuthorEmail}> - All rights reserved. See LICENSE file
*/
class {ClassName} extends BaseBean
{

    /**
     * @example {TableComment}
     */
    const TABLE = "{TableName}";
    public function getTableRule()
    {
        return '{Rule}';
    }
<!-- END PhpHeader -->
<!-- BEGIN PkAttribute -->
    /**
     * Class attribute for mapping the primary key {TablePkName} of table {TableName}
     *
     * Comment for field {TablePkName}: {Comment}<br>
     * @var {ClassPkAttributeType} ${ClassPkAttributeName}
     */
    private ${ClassPkAttributeName};
<!-- END PkAttribute -->
<!-- BEGIN Attributes -->
    /**
     * Class attribute for mapping table field {TableFieldName}
     *
     * Comment for field {TableFieldName}: {Comment}.<br>
     * Field information:
     *  - Data type: {TableFieldTypeAndLenght}
     *  - Null : {TableFieldNullable}
     *  - DB Index: {TableFieldIndex}
     *  - Default: {TableFieldDefault}
     *  - Extra:  {TableFieldExtra}
     * @var {ClassAttributeType} ${ClassAttributeName}
     */
    public ${ClassAttributeName};
<!-- END Attributes -->

<!-- BEGIN SingleAttributes -->
    /**
     * {TableFieldName}
     * @example {Comment}
     * @var {ClassAttributeType} ${ClassAttributeName}
     */
    public ${ClassAttributeName};
    public function get_{ClassAttributeName}_rule()
    {
        return '{Rule}';
    }
<!-- END SingleAttributes -->
<!-- BEGIN DdlAttribute -->
    /**
     * Class attribute for storing the SQL DDL of table {TableName}
     * @var string base64 encoded string for DDL
     */
    private $ddl = "{Ddl}";
<!-- END DdlAttribute -->
<!-- BEGIN Setters -->
    /**
     * {SetterMethod} Sets the class attribute {ClassAttributeName} with a given value
     *
     * The attribute {ClassAttributeName} maps the field {TableFieldName} defined as {TableFieldTypeAndLenght}.<br>
     * Comment for field {TableFieldName}: {Comment}.<br>
     * @param {ClassAttributeType} ${ClassAttributeName}
     * @category Modifier
     */
    public function {SetterMethod}(${ClassAttributeName})
    {
        $this->{ClassAttributeName} = {Cast}${ClassAttributeName};
        $this->setMap["{ClassAttributeOriginName}"] = {Cast}${ClassAttributeName};
    }
<!-- END Setters -->
<!-- BEGIN Getters -->
    /**
     * {GetterMethod} gets the class attribute {ClassAttributeName} value
     *
     * The attribute {ClassAttributeName} maps the field {TableFieldName} defined as {TableFieldTypeAndLenght}.<br>
     * Comment for field {TableFieldName}: {Comment}.
     * @return {ClassAttributeType} ${ClassAttributeName}
     * @category Accessor of ${ClassAttributeName}
     */
    public function {GetterMethod}()
    {
        return $this->{ClassAttributeName};
    }
<!-- END Getters -->
<!-- BEGIN DdlGetter -->
    /**
     * Gets DDL SQL code of the table {TableName}
     * @return string
     * @category Accessor
     */
    public function getDdl()
    {
        return base64_decode($this->ddl);
    }
<!-- END DdlGetter -->
<!-- BEGIN TableGetter -->
    /**
    * Gets the name of the managed table
    * @return string
    * @category Accessor
    */
    public function getTableName()
    {
        return "{TableName}";
    }
<!-- END TableGetter -->
<!-- BEGIN PhpFooter -->
}
?>
<!-- END PhpFooter -->
