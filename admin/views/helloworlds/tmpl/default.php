<?php
/**
 * @package     Joomla.Tutorials
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     License GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

// Load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_helloworld'); ?>" method="post" name="adminForm" id="adminForm">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5">
          <?php echo JText::_('COM_HELLOWORLD_HELLOWORLD_HEADING_ID'); ?>
        </th>
        <th width="20">
          <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
        </th>			
        <th>
          <?php echo JText::_('COM_HELLOWORLD_HELLOWORLD_HEADING_GREETING'); ?>
        </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="3"><?php echo $this->pagination->getListFooter(); ?></td>
      </tr>

    </tfoot>
    <tbody>
      <?php foreach ($this->items as $i => $item): ?>
        <tr class="row<?php echo $i % 2; ?>">
          <td>
            <?php echo $item->id; ?>
          </td>
          <td>
            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
          </td>
          <td>
            <?php echo $item->greeting; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>
